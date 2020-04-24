<?php
if(!isset($_GET['controller']) && !isset($_GET['action'])){
    require_once('controllers/TasksController.php'); 
    $controller = new TasksController();
    $controller->task_list();
}
elseif($_REQUEST['controller'] === 'Tasks'){
    require_once('controllers/TasksController.php');
    $controller = new TasksController();
    switch($_REQUEST['action']){
        case 'add':
            $task = [
                'user' => $_REQUEST['user'],
                'email' => $_REQUEST['email'],
                'text' => $_REQUEST['text']
            ];
            $controller->add_task($task);
        break;
    }
}
?>