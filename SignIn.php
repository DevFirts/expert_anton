<?php


class SignIn
{
    public function singIn($login, $userId, $pass = null) {
        $exprTime = time() + 3600;
        setcookie("is_auth", "1", $exprTime, "/");
        if ($login == "admin") {
            setcookie("is_admin", "1", $exprTime, "/");
        } else {
            setcookie("is_admin", "0", $exprTime, "/");
        }
        setcookie("user_id", $userId, $exprTime, "/");
        header('Location: http://expert-anton/');
    }
}