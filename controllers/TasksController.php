<?php
require_once('models/Tasks.php');

class TasksController{
    var $tasks;

    function __construct(){
        $this->tasks = new Tasks();
    }

    function task_list(){
        $data = $this->tasks->get_tasks();
        include 'views/TasksListView.php';
    }

    function add_task($task){
        $data = $this->tasks->add_task($task);
        echo $data;
    }

    function edit_task_text($task_id, $new_text){
        if(isset($_SESSION['admin'])){
            $data = $this->tasks->edit_task_text($task_id, $new_text);
            echo $data;
        }
        else{
            $res['success'] = false;
            $res['message'] = 'Действие доступно только администраторам';
            echo json_encode($res);
        }
    }

    function edit_task_status($task_id, $new_status){
        if(isset($_SESSION['admin'])){
            $data = $this->tasks->edit_task_status($task_id, $new_status);
            echo $data;
        }
        else{
            $res['success'] = false;
            $res['message'] = 'Действие доступно только администраторам';
            echo json_encode($res);
        }
    }
}