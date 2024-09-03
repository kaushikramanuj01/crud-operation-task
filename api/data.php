<?php
require_once '../config/init.php';

header('Content-Type: application/json');
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$status = 0;
$message = 0;
// $success = 0;

$action = isset($data['action']) ? $data['action'] : '';
$response = array();
// sleep(10);

if ($action == "viewrecord") {
    $pageno = (int) isset($data['pageno']) ? $data['pageno'] : '';
    $perpage = (int) isset($data['perpage']) ? $data['perpage'] : '';

    $skip = ($pageno - 1) * $perpage;
    $response['skip'] =$skip;

    $where = array(); // Customize the WHERE clause
    $sort = "id DESC"; // Customize the sorting

    $allrecord = $SubDB->execute("tblrecord", $where,$sort,$perpage,$skip);
    
    // Get total records
    $total_records_sql = "SELECT COUNT(*) FROM tblrecord";
    $result = $conn->query($total_records_sql);
    $total_records = $result->fetch_array()[0];
    $total_pages = ceil($total_records / $perpage);
    $response['total_pages'] = $total_pages;

    $data = "";
    $tempnum = $skip+1;
    if($pageno == 1){
        $tempnum = 1;
    }
    foreach($allrecord as $value){
        $_id = $value['_id'];
        $name = $value['name'];
        $mobile = $value['mobile'];
        $email = $value['email'];
        $designation = $value['designation'];
        $profilePicture = $value['profilePicture'];

            $data .= '<tr class="table_con"><td>'. $tempnum .'</td><td>'. $name .'</td><td>'.$mobile.'</td><td>'. $email .'</td><td>'. $designation .'</td><td class="action_sec"><button class="btn update-btn" data-id="'. $_id .'"><img src="component/icon/edit.png" alt="" srcset="" style="width: 20px;"></button><button class="btn delete-btn" data-id="'. $_id .'"><img src="component/icon/delete.png" alt="" srcset="" style="width: 20px;"></button><button class="btn view-btn" data-url="'. $profilePicture .'"><img src="component/icon/view.png" alt="" srcset="" style="width: 20px;"></button></td</tr>';

            $tempnum++;
    }

    $message = "Data found.";
    $status = 1;

    $loadmore = 1;
    if(sizeof($allrecord) < $perpage){
        $loadmore = 0;
    }

    $response['loadmore'] = $loadmore;
    $response['data'] = $data;
    $response['nextpage'] = $pageno+1;
}
else if ($action == "searchData") {
    $dataload = 0;
    $pageno = (int) isset($data['pageno']) ? $data['pageno'] : '';
    $perpage = (int) isset($data['perpage']) ? $data['perpage'] : '';
    $query = isset($data['query']) ? $data['query'] : '';

    $skip = ($pageno - 1) * $perpage;
    $response['skip'] =$skip;

    $search_query = $conn->real_escape_string($query);
    // Query to count total matching records
    $total_records_sql = "SELECT COUNT(*) as count FROM tblrecord 
    WHERE name LIKE '%$search_query%' 
    OR mobile LIKE '%$search_query%' 
    OR email LIKE '%$search_query%'";

    $result = $conn->query($total_records_sql);
    $total_records = $result->fetch_assoc()['count'];
    $total_pages = ceil($total_records / $perpage);
    $response['total_pages'] = $total_pages;
    

    // Modify SQL query to search multiple fields
    $sql = "SELECT * FROM tblrecord 
            WHERE name LIKE '%$search_query%' 
            OR mobile LIKE '%$search_query%' 
            OR email LIKE '%$search_query%'";

    // Implement Pagination
    $start_from = ($pageno-1) * $perpage;

    $sql .= " LIMIT $start_from, $perpage";
    $result = $conn->query($sql);

    $data = "";
    if($pageno == 1){
        $tempnum = 1;
    }else{
        $tempnum = $start_from+1;
    }
    // Display results
    $dataload = $result->num_rows;
    if ($dataload > 0) {
        while($row = $result->fetch_assoc()) {
            $_id = $row['_id'];
            $name = $row['name'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $designation = $row['designation'];
            $profilePicture = $row['profilePicture'];

            $data .= '<tr class="table_con"><td>'. $tempnum .'</td><td>'. $name .'</td><td>'.$mobile.'</td><td>'. $email .'</td><td>'. $designation .'</td><td class="action_sec"><button class="btn update-btn" data-id="'. $_id .'"><img src="component/icon/edit.png" alt="" srcset="" style="width: 20px;"></button><button class="btn delete-btn" data-id="'. $_id .'"><img src="component/icon/delete.png" alt="" srcset="" style="width: 20px;"></button><button class="btn view-btn" data-url="'. $profilePicture .'"><img src="component/icon/view.png" alt="" srcset="" style="width: 20px;"></button></td</tr>';

            $tempnum++;
        }

        $loadmore = 1;
        if($dataload < $perpage){
            $loadmore = 0;
        }
        $message = "Data found.";
        $status = 1;
    } else {
        $message = "No data found.";
        $loadmore = 0;
        $dataload = 0;
    }

    $response['dataload'] = $dataload;
    $response['loadmore'] = $loadmore;
    $response['data'] = $data;
    $response['nextpage'] = $pageno+1;
}
else if ($action == "fetchData") {
    $recordId = isset($data['recordId']) ? $data['recordId'] : '';

    $where = array(
        "_id" => $recordId
    ); // WHERE clause
    $sort = "";
    $fetchedRecord = $SubDB->execute("tblrecord", $where,$sort,"","");

    $response['data'] = $fetchedRecord;
    $message = "Data found.";
    $status = 1;
}
else if ($action == "deleteRecord") {
    $recordId = isset($data['recordId']) ? $data['recordId'] : '';

    $options = array();
    $where = array(
        "_id" => $recordId
    );
    $SubDB->performCRUD("tblrecord", "d", $options, $where);

    $message = "Data deleted successfully.";
    $status = 1;
}

$response['message'] = $message;
$response['status'] = $status;
// $response['success'] = $success;

echo json_encode($response);
?>