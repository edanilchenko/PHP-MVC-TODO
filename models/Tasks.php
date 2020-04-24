<?php
class Tasks{
    var $tasks = array();

    function get_tasks(){
        array_push($this->tasks, [
            'name' => 'Vasya', 
            'email' => 'vasya@mail.com', 
            'text' => 'Почистить зубы', 
            'is_closed' => false, 
            'is_edited' => false
        ]);
        array_push($this->tasks, [
            'name' => 'Petya', 
            'email' => 'petya@mail.com', 
            'text' => 'Погладить кота', 
            'is_closed' => false, 
            'is_edited' => false
        ]);
        // array_push($tasks, ['Ivan', 'ivan@mail.com', 'Выкинуть мусор', false, false]);
        // array_push($tasks, ['Fedor', 'fedor@mail.com', 'Съесть борщ', false, false]);

        return $this->tasks;
    }

    function add_task($task = array()){
        array_push($this->tasks, $task);
        var_dump($this->tasks);
        return 'Task was added successfully!';
    }
}