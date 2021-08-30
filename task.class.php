<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null, $setID = null, $setName = null, $setDesc = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id,$setName,$setDesc))
            $this->Create($setName, $setDesc);
    }
    protected function Create($setName = null, $setDesc = null) {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = $setName;
        $this->TaskDescription = $setDesc;
        
        //create object to add to current list of tasks
        $obj = new stdClass();
        $obj->TaskId = $this->TaskId;
        $obj->TaskName = $this->TaskName;
        $obj->TaskDescription = $this->TaskDescription;
        
        //push new task to list
        if ($this->TaskName) {
            array_push($this->TaskDataSource,$obj);      
            $saveOverText = json_encode($this->TaskDataSource);           
            $this->updateFile($saveOverText);
        }  

    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID
    $biggest = 0;
        foreach ($this->TaskDataSource as $lookID) {
          if ($biggest < $lookID->TaskId){
              $biggest = $lookID->TaskId;
          }  
        }
        $biggest ++;
        
        return $biggest; 
    }
    protected function LoadFromId($Id = null, $setName = null,$setDesc=null) {
        if ($Id) {
            // Assignment: Code to load details here...
            
            //create new object to replace current (Edit the entry)
            $obj = new stdClass();
            $obj->TaskId = $Id;
            $obj->TaskName = $setName;
            $obj->TaskDescription = $setDesc;

            $key = 0;
            $placeholderSource = $this->TaskDataSource;
            foreach ($this->TaskDataSource as $updateID) {       
               if ($updateID->TaskId == $Id) {                                         
                     $placeholderSource[$key] = $obj;                                         
                }                  
                $key++;
            }
            $newStringFinal = json_encode($placeholderSource);
            $this->updateFile($newStringFinal);

        } else
            return null;
    }
    //function to overwrite file with all the new /edited tasks
    protected function updateFile($string) {
        $file=fopen('Task_Data.txt','w');
        fwrite($file,$string);
        fclose($file);
    }

    public function Save($recievedName, $recievedDesc) {
        //Assignment: Code to save task here 
         $this->Create($recievedName, $recievedDesc);         
  
    }
    public function Delete($recievedID) {
        //Assignment: Code to delete task here
        $key = 0;
        $placeholderSource = $this->TaskDataSource;
        foreach ($this->TaskDataSource as $deleteID) {       
           if ($deleteID->TaskId == $recievedID) {                
                  unset($placeholderSource[$key]);
                  $placeholderSource = array_values($placeholderSource);                                          
            }
            $key++;
        }
        
        $newStringFinal = json_encode($placeholderSource);
       $this->updateFile($newStringFinal);        
    }

    public function Update($recievedID,$recievedName, $recievedDesc) { 
        
        $this->LoadFromId($recievedID,$recievedName, $recievedDesc);

}
}
?>