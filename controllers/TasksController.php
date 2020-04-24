<?php
require_once('models/Tasks.php');

class TasksController{
    var $tasks;

    function __construct(){
        $this->$tasks = new Tasks();
    }

    function task_list(){
        $data = $this->$tasks->get_tasks();
        include 'views/TasksListView.php';
    }

    function add_task($task){
        $data = $this->$tasks->add_task($task);
        return $data;
    }
}