<?php
header('Content-Type: application/json');
include("config.php"); 

$sql = "SELECT * FROM program_tanam";
$result = $con->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>