<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0){
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
           // var_dump($this->TaskDataSource); works
        }
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create($setID, $setName = null, $setDesc = null);
    }
    protected function Create($setID, $setName, $setDesc) {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId($setID);
        $this->TaskName = $setName;
        $this->TaskDescription = $setDesc;

        $obj = new \stdClass();
        $obj->data = array(3,'johms','laundry');

        var_dump (json_encode($obj));

        //array_push($this->TaskDataSource, $this->TaskId,$this->TaskName,$this->TaskDescription);

       var_dump($this->TaskDataSource);
    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID
        return -2; // Placeholder return for now
    }
    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
            //if specific ID is chosed. Load and put data in the model to be edited
        } else
            return null;
    }

    public function Save($recievedID, $recievedName, $recievedDesc) {
        //Assignment: Code to save task here
        if ($recievedID == -1) return 'Looks like a new one eh';
            // $recievedName;
            Create($recievedID, $recievedName, $recievedDesc);
            
        return 'output some html from Save()';
    }
    public function Delete($recievedID) {
        //Assignment: Code to delete task here
        return 'I need to delete item ID '.$recievedID;
    }
}
?>