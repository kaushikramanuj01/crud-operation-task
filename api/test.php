<?php
require_once '../config/init.php';


$testData = [
    ['name' => 'John Doe', 'mobile_number' => '1234567890', 'email' => 'john.doe@example.com', 'designation' => 'Software Engineer'],
    ['name' => 'Jane Smith', 'mobile_number' => '2345678901', 'email' => 'jane.smith@example.com', 'designation' => 'Project Manager'],
    ['name' => 'Alice Johnson', 'mobile_number' => '3456789012', 'email' => 'alice.johnson@example.com', 'designation' => 'UX Designer'],
    ['name' => 'Bob Brown', 'mobile_number' => '4567890123', 'email' => 'bob.brown@example.com', 'designation' => 'Data Analyst'],
    ['name' => 'Charlie Davis', 'mobile_number' => '5678901234', 'email' => 'charlie.davis@example.com', 'designation' => 'System Administrator'],
    ['name' => 'David Wilson', 'mobile_number' => '6789012345', 'email' => 'david.wilson@example.com', 'designation' => 'Database Administrator'],
    ['name' => 'Eva Miller', 'mobile_number' => '7890123456', 'email' => 'eva.miller@example.com', 'designation' => 'Front-End Developer'],
    ['name' => 'Frank Moore', 'mobile_number' => '8901234567', 'email' => 'frank.moore@example.com', 'designation' => 'Back-End Developer'],
    ['name' => 'Grace Taylor', 'mobile_number' => '9012345678', 'email' => 'grace.taylor@example.com', 'designation' => 'Full Stack Developer'],
    ['name' => 'Henry Anderson', 'mobile_number' => '0123456789', 'email' => 'henry.anderson@example.com', 'designation' => 'DevOps Engineer'],
    ['name' => 'Isabella Thomas', 'mobile_number' => '1234567891', 'email' => 'isabella.thomas@example.com', 'designation' => 'Network Engineer'],
    ['name' => 'Jack Harris', 'mobile_number' => '2345678902', 'email' => 'jack.harris@example.com', 'designation' => 'IT Support Specialist'],
    ['name' => 'Katherine Clark', 'mobile_number' => '3456789013', 'email' => 'katherine.clark@example.com', 'designation' => 'Business Analyst'],
    ['name' => 'Liam Lewis', 'mobile_number' => '4567890124', 'email' => 'liam.lewis@example.com', 'designation' => 'Quality Assurance'],
    ['name' => 'Mia Walker', 'mobile_number' => '5678901235', 'email' => 'mia.walker@example.com', 'designation' => 'Product Manager'],
    ['name' => 'Noah Hall', 'mobile_number' => '6789012346', 'email' => 'noah.hall@example.com', 'designation' => 'Sales Engineer'],
    ['name' => 'Olivia Allen', 'mobile_number' => '7890123457', 'email' => 'olivia.allen@example.com', 'designation' => 'Customer Success Manager'],
    ['name' => 'Paul Young', 'mobile_number' => '8901234568', 'email' => 'paul.young@example.com', 'designation' => 'Marketing Specialist'],
    ['name' => 'Quinn King', 'mobile_number' => '9012345679', 'email' => 'quinn.king@example.com', 'designation' => 'Content Creator'],
    ['name' => 'Rachel Scott', 'mobile_number' => '0123456790', 'email' => 'rachel.scott@example.com', 'designation' => 'Graphic Designer'],
    ['name' => 'Samuel Wright', 'mobile_number' => '1234567892', 'email' => 'samuel.wright@example.com', 'designation' => 'SEO Specialist'],
    ['name' => 'Taylor Green', 'mobile_number' => '2345678903', 'email' => 'taylor.green@example.com', 'designation' => 'Social Media Manager'],
    ['name' => 'Uma Adams', 'mobile_number' => '3456789014', 'email' => 'uma.adams@example.com', 'designation' => 'Video Editor'],
    ['name' => 'Victor Baker', 'mobile_number' => '4567890125', 'email' => 'victor.baker@example.com', 'designation' => 'Web Designer'],
    ['name' => 'Wendy Carter', 'mobile_number' => '5678901236', 'email' => 'wendy.carter@example.com', 'designation' => 'Product Designer'],
    ['name' => 'Xander Evans', 'mobile_number' => '6789012347', 'email' => 'xander.evans@example.com', 'designation' => 'Cloud Engineer'],
    ['name' => 'Yara Mitchell', 'mobile_number' => '7890123458', 'email' => 'yara.mitchell@example.com', 'designation' => 'IT Consultant'],
    ['name' => 'Zachary Roberts', 'mobile_number' => '8901234569', 'email' => 'zachary.roberts@example.com', 'designation' => 'Technical Writer'],
    ['name' => 'Alice Morgan', 'mobile_number' => '9012345680', 'email' => 'alice.morgan@example.com', 'designation' => 'HR Manager'],
    ['name' => 'Bob Martinez', 'mobile_number' => '0123456791', 'email' => 'bob.martinez@example.com', 'designation' => 'Recruiter'],
    ['name' => 'Charlie Lee', 'mobile_number' => '1234567893', 'email' => 'charlie.lee@example.com', 'designation' => 'Operations Manager'],
    ['name' => 'Diana Murphy', 'mobile_number' => '2345678904', 'email' => 'diana.murphy@example.com', 'designation' => 'Account Manager'],
    ['name' => 'Edward Perry', 'mobile_number' => '3456789015', 'email' => 'edward.perry@example.com', 'designation' => 'Financial Analyst'],
    ['name' => 'Fiona Reed', 'mobile_number' => '4567890126', 'email' => 'fiona.reed@example.com', 'designation' => 'Business Development Manager'],
    ['name' => 'George Bennett', 'mobile_number' => '5678901237', 'email' => 'george.bennett@example.com', 'designation' => 'Systems Analyst'],
    ['name' => 'Hannah Barnes', 'mobile_number' => '6789012348', 'email' => 'hannah.barnes@example.com', 'designation' => 'Customer Support Specialist'],
    ['name' => 'Ian Hughes', 'mobile_number' => '7890123459', 'email' => 'ian.hughes@example.com', 'designation' => 'Event Coordinator'],
    ['name' => 'Jessica Collins', 'mobile_number' => '8901234570', 'email' => 'jessica.collins@example.com', 'designation' => 'Administrative Assistant'],
    ['name' => 'Kyle Foster', 'mobile_number' => '9012345681', 'email' => 'kyle.foster@example.com', 'designation' => 'Legal Advisor'],
    ['name' => 'Laura Gonzalez', 'mobile_number' => '0123456792', 'email' => 'laura.gonzalez@example.com', 'designation' => 'Compliance Officer'],
    ['name' => 'Michael Ward', 'mobile_number' => '1234567894', 'email' => 'michael.ward@example.com', 'designation' => 'IT Manager'],
    ['name' => 'Nina Griffin', 'mobile_number' => '2345678905', 'email' => 'nina.griffin@example.com', 'designation' => 'Design Lead'],
    ['name' => 'Oliver Wells', 'mobile_number' => '3456789016', 'email' => 'oliver.wells@example.com', 'designation' => 'SEO Manager'],
    ['name' => 'Paula Diaz', 'mobile_number' => '4567890127', 'email' => 'paula.diaz@example.com', 'designation' => 'Content Strategist'],
    ['name' => 'Quincy Wood', 'mobile_number' => '5678901238', 'email' => 'quincy.wood@example.com', 'designation' => 'Sales Manager'],
    ['name' => 'Riley Cook', 'mobile_number' => '6789012349', 'email' => 'riley.cook@example.com', 'designation' => 'Technical Support Specialist'],
    ['name' => 'Samantha Price', 'mobile_number' => '7890123460', 'email' => 'samantha.price@example.com', 'designation' => 'Product Marketing Manager'],
    ['name' => 'Thomas Hughes', 'mobile_number' => '8901234571', 'email' => 'thomas.hughes@example.com', 'designation' => 'Chief Technology Officer'],
    ['name' => 'Ursula Rivera', 'mobile_number' => '9012345682', 'email' => 'ursula.rivera@example.com', 'designation' => 'Operations Director'],
    ['name' => 'Victor Hughes', 'mobile_number' => '0123456793', 'email' => 'victor.hughes@example.com', 'designation' => 'Chief Financial Officer'],
    ['name' => 'Wendy Sanders', 'mobile_number' => '1234567895', 'email' => 'wendy.sanders@example.com', 'designation' => 'Chief Executive Officer']
];

// ['name' => 'John Doe', 'mobile_number' => '1234567890', 'email' => 'john.doe@example.com', 'designation' => 'Software Engineer'],
    
foreach($testData as $data){
    $name = $data['name'];
    $contact = $data['mobile_number'];
    $email = $data['email'];
    $designation = $data['designation'];

    $_id = $SubDB->generateUniqueID();

    // 98fa6509dprofile_imag8219.jpg

    // $upload_path = "uploads/" . $_id . "profile_imag8219.jpg";

    // Define the source path and the target directory
    $source_path = 'profile_imag8219.jpg'; // Path to the source image
    $target_dir = '../uploads/'; // Target directory
    $new_name = $_id . "profile_imag8219.jpg"; // New name for the image

    $upload_path = "uploads/" . $new_name;

    // Define the target path with the new name
    $target_path = $target_dir . $new_name;

    // Copy the file to the target directory with the new name
    if (copy($source_path, $target_path)) {
        echo "The image has been copied and renamed successfully.";
    } else {
        echo "Sorry, there was an error copying the image.";
    }

    $userData = array(
        "_id" => $_id,
        "name" => $name,
        "mobile" => $contact,
        "email" => $email,
        "profilePicture" => $upload_path,
        "designation" => $designation,
    );

    $where = array(); // Use appropriate where conditions
    
    $SubDB->performCRUD("tblrecord", "i", $userData, $where);

    // exit();
}

exit();

for ($i=1; $i < 100; $i++) { 
    # code...
    
    $data .= "INSERT INTO `tblrecord2` (`id`, `_id`, `name`, `mobile`, `email`, `designation`, `date`) VALUES(".$i.", 'jgvy65r654ghv675vj', 'kaushik', 9925884594, 'kaushik@gmail.com', 'web developer', '2024-09-01 16:20:53')\n\n<br>";

}

echo $data;
?>