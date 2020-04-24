<?php
class UsersController{
    function auth($login, $password){
        if(($login === 'admin') && ($password === '123')){
            $_SESSION['admin'] = '1';
            return 'Вы успешно авторизованы';
        }
        else{
            return 'Неверное имя пользователя или пароль';
        }
    }

    function logout(){
        unset($_SESSION['admin']);
        echo 'Вы успешно разлогинены';
    }
}