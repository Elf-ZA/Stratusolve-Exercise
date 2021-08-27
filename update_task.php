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

if (isset($do)) {
    if ($do == "show") { 
        include('list_tasks.php');       
        die($html);
    } elseif ($do == "save") {
        $save = $Task->Save($curID, $name, $description);     
        var_dump($save);  
        echo ($save);
    } elseif ($do == "delete") {
        $delete = $Task->Delete($curID);
        echo ($delete);
    } 
}

?>