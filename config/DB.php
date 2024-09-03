<?php

class SubDB{

function performCRUD($tableName, $operation, $data, $where)
{
    global $conn;

    foreach ($data as $key => $value) {
        $data[$key] = $conn->real_escape_string($value);
    }

    switch (strtolower($operation)) {
        case 'i': // Insert
            $columns = implode(", ", array_keys($data));
            $values = "'" . implode("', '", $data) . "'";
            $sql = "INSERT INTO `$tableName` ($columns) VALUES ($values)";
            break;

        case 'u': // Update
            $updateData = "";
            foreach ($data as $key => $value) {
                $updateData .= "$key = '$value', ";
            }
            $updateData = rtrim($updateData, ", ");
            $whereClause = "";
            foreach ($where as $key => $value) {
                $whereClause .= "$key = '$value' AND ";
            }
            $whereClause = rtrim($whereClause, " AND ");
            $sql = "UPDATE $tableName SET $updateData WHERE $whereClause";
            break;

        case 'd': // Delete
            $whereClause = "";
            foreach ($where as $key => $value) {
                $whereClause .= "$key = '$value' AND ";
            }
            $whereClause = rtrim($whereClause, " AND ");
            $sql = "DELETE FROM $tableName WHERE $whereClause";
            break;

        case 'r': // Read
            $whereClause = "";
            foreach ($where as $key => $value) {
                $whereClause .= "$key = '$value' AND ";
            }
            $whereClause = rtrim($whereClause, " AND ");
            $sql = "SELECT * FROM $tableName WHERE $whereClause";
            $result = $conn->query($sql);
            
            // Handle the result as needed
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Process each row
                    print_r($row);
                }
            } else {
                echo "0 results";
            }
            break;

        default:
            echo "Invalid operation";
            return;
    }

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        $message = "Operation successfully executed";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
    return $message;
}

function execute($tableName, $where = array(), $sort = '', $limit = '',$skip = '')
{
    global $conn;
    // Construct the SQL query
    $sql = "SELECT * FROM $tableName";

    // Add WHERE clause if provided
    if (!empty($where)) {
        $whereClause = "";
        foreach ($where as $key => $value) {
            $whereClause .= "$key = '$value' AND ";
        }
        $whereClause = rtrim($whereClause, " AND ");
        $sql .= " WHERE $whereClause";
    }

    // Add sorting if provided
    if (!empty($sort)) {
        $sql .= " ORDER BY $sort";
    }
    // Add limit if provided
    if (!empty($limit)) {
        $sql .= " LIMIT $limit";
    }
    // Add skip if provided
    if (!empty($skip)) {
        $sql .= " OFFSET $skip";
    }

    // echo $sql;
    // Execute the query
    // $result = [];
    $result = $conn->query($sql);

    $data = array();

    // if ($result === false) {
    //     // Handle the query execution error
    //     echo "Query execution failed: " . $conn->error;
    // } else {}
    // Handle the result
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Process each row
            $data[] = $row;
        }
    }

    return $data; // Return the array of results
}

function generateUniqueID() {
    // Generate a unique ID using uniqid and additional entropy
    $uniqueID = uniqid('', true);
    // Use md5 to hash the unique ID
    $hashedID = md5($uniqueID);
    // Take the first 15 characters of the hashed ID
    $result = substr($hashedID, 0, 9);
    return $result;
}

function sanitize($input) {
    // Remove leading and trailing whitespace
    $input = trim($input);
    // Remove backslashes
    $input = stripslashes($input);
    // Convert special characters to HTML entities to prevent XSS attacks
    $input = htmlspecialchars($input);

    return $input;
}
}

// Example usage:
// $tableName = "users";
// $where = array("status" => "active"); // Customize the WHERE clause as needed
// $sort = "created_at DESC"; // Customize the sorting as needed
// $limit = "10"; // Customize the limit as needed

// $userData = retrieveData($tableName, $where, $sort, $limit);

// Use $userData as needed...


// // Example usage
// $tableName = "your_table_name";
// $operation = "i"; // 'i' for insert, 'u' for update, 'd' for delete, 'r' for read
// $data = array("column1" => "value1", "column2" => "value2");
// $where = array("id" => 1); // Use appropriate where conditions

// performCRUD($tableName, $operation, $data, $where);

// Close the database connection
// $conn->close();

?>