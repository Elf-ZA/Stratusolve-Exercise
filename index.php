<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 13052016
 * Time: 08:48
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Basic Task Manager</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form id="form" action="update_task.php" method="post">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 5px;;">
                            <input id="InputTaskName" type="text" placeholder="Task Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <textarea id="InputTaskDescription" placeholder="Description" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="deleteTask" type="button" class="btn btn-danger">Delete Task</button>
                <button id="saveTask" type="button" class="btn btn-primary">Save changes</button>
                <button id="updateTask" type= "button" class= "btn btn-primary">Update changes</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <h2 class="page-header">Task List</h2>
        <div id="debug">
               
        </div>
            <!-- Button trigger modal -->
            <button id="newTask" type="button" class="btn btn-primary btn-lg" style="width:100%;margin-bottom: 5px;" data-toggle="modal" data-target="#myModal">
                Add Task
            </button>
            <div id="TaskList" class="list-group">
                 <!-- Assignment: These are simply dummy tasks to show how it should look and work. You need to dynamically update this list with actual tasks --> 
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var currentTaskId = -1;
    var doStuff = {task:null,id:currentTaskId, name: null, desc: null};

    $('#myModal').on('show.bs.modal', function (event) {
        var triggerElement = $(event.relatedTarget); // Element that triggered the modal
        var modal = $(this);
        if (triggerElement.attr("id") == 'newTask') {
            modal.find('.modal-title').text('New Task');
            $('#deleteTask').hide();
            $('#updateTask').hide();
            $('#saveTask').show();
            currentTaskId = -1;
        } else {
            modal.find('.modal-title').text('Task details');
            $('#deleteTask').show();
            $('#updateTask').show();
            $('#saveTask').hide();
            currentTaskId = triggerElement.attr("id");
            //See if I can't pull name and desc from html via jquery. Instead of txt.
        }
    });

    $('#saveTask').click(function() {
        //Assignment: Implement this functionality
       // alert('Save... Id:'+currentTaskId);
        var Tname = $('#InputTaskName').val(); 
        var Tdesc = $('#InputTaskDescription').val();

            if (!Tname || !Tdesc) {
                alert('Name or Description empty');
            } else {
                 $('#myModal').modal('hide');
                 doStuff = {task:'save',id: currentTaskId, name: Tname, desc: Tdesc};
                 updateTaskList(doStuff); 
                 $('#form')[0].reset();
            }           
    });

    $('#deleteTask').click(function() {
        //Assignment: Implement this functionality
       // alert('Delete... Id:'+currentTaskId);
        $('#myModal').modal('hide');
        doStuff = {task:'delete',id: currentTaskId, name: null, desc: null}
        updateTaskList(doStuff);
    });
    $('#updateTask').click( () => {
                
        var Tname = $('#InputTaskName').val(); 
        var Tdesc = $('#InputTaskDescription').val();

            if (!Tname || !Tdesc) {
                alert('Name or Description empty');
            } else {
                $('#myModal').modal('hide');
                doStuff = {task:'update',id: currentTaskId, name: Tname, desc: Tdesc};
                updateTaskList(doStuff);
            }

    })
    
    function showTaskList() {
        $.post("list_tasks.php",(data) => {
            $( "#TaskList" ).html( data );
        });
    }

    function updateTaskList(gotStuff) {
        $.post("update_task.php", gotStuff,function( data ) {
            $( "#debug" ).html( data );            
            showTaskList();           
        });
    }
    showTaskList();
</script>
</html>