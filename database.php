<?php
$database = new mysqli("localhost", "root", "", "zoo_assad");

function get_data($command){
    echo $command;
}
//get_data("SELECT id, username, email FROM users WHERE id = ?");
?>