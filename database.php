<?php
$database = new mysqli("localhost", "root", "", "zoo_assad");

function extract_rows($table){
    $rowsArray = [];
    while($row = $table->fetch_assoc()){
        array_push($rowsArray, $row);
    }
    return $rowsArray;
}

function get_data($command, $param, $values){
    global $database;
    $pre = $database->prepare($command);
    $pre->bind_param($param, ...$values);
    $pre->execute();
    $result = $pre->get_result();
    $pre->close();

    return extract_rows($result);
}

//$database->close();
?>