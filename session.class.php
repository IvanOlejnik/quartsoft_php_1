<?php

abstract class Session
{
    //метод записывает в сессию имя пользователя
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    //данный метод влзвращает значение переменной сессии
    public static function get($key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    //проверка переменных сесиии на существование
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    //удаляем переменные из сессиии 
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    //зактрытие сессии
    public static function destroy()
    {
        session_destroy();
    }
}
?>