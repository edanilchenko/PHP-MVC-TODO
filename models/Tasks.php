<?php
class Tasks{
    var $tasks = array();

    function get_tasks(){
        require_once('db.php');
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }
        $result = $mysqli->query("SELECT * FROM tasks;");
        $tasks = array();
        while( $row = $result->fetch_assoc() ){
            array_push($tasks, $row);
        }
        $mysqli->close();

        return json_encode($tasks);
    }

    function add_task($task = array()){
        require_once('db.php');
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }
        extract($task);
        var_dump($task);
        $result = $mysqli->query("INSERT INTO tasks(Name, Email, Text, Closed) VALUES ('$name', '$email', '$text', 'Open');");
        $mysqli->close();

        return $result;
    }

    function edit_task_text($task_id, $new_text){
        require_once('db.php');
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }
        $result = $mysqli->query("UPDATE tasks SET Text = '$new_text', Edited = 'Изменено' WHERE idTasks = '$task_id'");
        $mysqli->close();

        return $result;
    }

    function edit_task_status($task_id, $new_status){
        require_once('db.php');
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }
        $result = $mysqli->query("UPDATE tasks SET Status = '$new_status' WHERE idTasks = '$task_id'");
        $mysqli->close();

        return $result;
    }
}