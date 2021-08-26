<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('task.class.php');
// Assignment: Implement this script
/*     $receivedFunct = $_POST['task'];
    $recivedID = $_POST['ID']; */
$task = $_POST['task'];

if (isset($task)) {
   // var_dump($task);
    if ($task == "show") {
        echo(' if-hello');
    } elseif ($task == "save") {
        $sav = new Task();
        $return = $sav->Save();
        var_dump($return);
        echo ($return);
    } elseif ($task == "delete") {
        echo (' if-delete');
    } 
}
echo($task);
/* chooseTask($task);

function chooseTask($giveTask) {

}
 */


?>