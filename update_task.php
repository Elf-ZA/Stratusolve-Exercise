<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script
    $receivedFunct = $_POST['task'];
    $recivedID = $_POST['ID'];

    if ($receivedFunct == 'save') {
        Save();
    }
    if ($receivedFunct == 'delete') {
        Delete();
    }
    if ($receivedFunct == 'show') {
        __construct();
    }
?>