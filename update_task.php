<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('task.class.php');
// Assignment: Implement this script


$do = $_POST['task'];
$curID = $_POST['id'];
$description = $_POST['desc'];
$name = $_POST['name'];

$Task = new Task();


if (isset($do) && isset($curID) || isset($description) || isset($name)) {
    if ($do == "save") {         
        $Task->Save($name, $description); 
    } elseif ($do == "update") {
        $update = $Task->Update($curID, $name, $description);
        echo($update);
    } elseif ($do == "delete") {
       $Task->Delete($curID);
    } 
}

?>