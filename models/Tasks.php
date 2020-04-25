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
            $row['Name'] = htmlspecialchars($row['Name']);
            $row['Email'] = htmlspecialchars($row['Email']);
            $row['Text'] = htmlspecialchars($row['Text']);
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
        $name = $mysqli->real_escape_string($task['name']);
        $email = $mysqli->real_escape_string($task['email']);
        $text = $mysqli->real_escape_string($task['text']);
        $result = $mysqli->query("INSERT INTO tasks(Name, Email, Text, Status) VALUES ('$name', '$email', '$text', 'Открыто');");
        $mysqli->close();

        if($result === true){
            $res['success'] = true;
            $res['message'] = 'Задача успешно добавлена';
        }
        else{
            $res['success'] = false;
            $res['message'] = 'Ошибка при добавлении задачи';
        }
        
        return json_encode($res);
    }

    function edit_task_text($task_id, $new_text){
        require_once('db.php');
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }
        $task_id = $mysqli->real_escape_string($task_id);
        $new_text = $mysqli->real_escape_string($new_text);
        $result = $mysqli->query("UPDATE tasks SET Text = '$new_text', Edited = 'Изменено' WHERE idTasks = '$task_id'");
        $mysqli->close();

        if($result === true){
            $res['success'] = true;
            $res['message'] = 'Задача успешно обновлена';
        }
        else{
            $res['success'] = false;
            $res['message'] = 'Ошибка при обновлении задачи';
        }
        
        return json_encode($res);
    }

    function edit_task_status($task_id, $new_status){
        require_once('db.php');
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
        }
        $task_id = $mysqli->real_escape_string($task_id);
        $new_status = $mysqli->real_escape_string($new_status);
        $result = $mysqli->query("UPDATE tasks SET Status = '$new_status' WHERE idTasks = '$task_id'");
        $mysqli->close();

        if($result === true){
            $res['success'] = true;
            $res['message'] = 'Статус успешно обновлен';
        }
        else{
            $res['success'] = false;
            $res['message'] = 'Ошибка при обновлении статуса';
        }
        
        return json_encode($res);
    }
}