<?php session_start();
if(!isset($_REQUEST['action'])){
    require_once('controllers/TasksController.php'); 
    $controller = new TasksController();
    $controller->task_list();
}
elseif($_REQUEST['action'] === 'add'){
    require_once('controllers/TasksController.php');
    $controller = new TasksController();
    $task = [
        'name' => $_REQUEST['name'],
        'email' => $_REQUEST['email'],
        'text' => $_REQUEST['text']
    ];
    $controller->add_task($task);
}
elseif($_REQUEST['action'] === 'auth'){
    require_once('controllers/UserController.php');
    $controller = new UsersController();
    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];
    $controller->auth($login, $password);
}
elseif($_REQUEST['action'] === 'logout'){
    require_once('controllers/UserController.php');
    $controller = new UsersController();
    $controller->logout();
}
elseif($_REQUEST['action'] === 'edit_text'){
    require_once('controllers/TasksController.php');
    $controller = new TasksController();
    $task_id = $_REQUEST['id'];
    $new_text = $_REQUEST['text'];
    $controller->edit_task_text($task_id, $new_text);
}
elseif($_REQUEST['action'] === 'edit_status'){
    require_once('controllers/TasksController.php');
    $controller = new TasksController();
    $task_id = $_REQUEST['id'];
    $new_status = $_REQUEST['status'];
    $controller->edit_task_status($task_id, $new_status);
}