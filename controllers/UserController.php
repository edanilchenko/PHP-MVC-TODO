<?php
class UsersController{
    function auth($login, $password){
        $res = array();
        if(($login === 'admin') && ($password === '123')){
            $_SESSION['admin'] = '1';
            $res['success'] = true;
            $res['message'] = 'Вы успешно авторизованы';
            echo json_encode($res);
        }
        else{
            $res['success'] = false;
            $res['message'] = 'Неверное имя пользователя или пароль';
            echo json_encode($res);
        }
    }

    function logout(){
        unset($_SESSION['admin']);
        echo 'Вы успешно разлогинены';
    }
}