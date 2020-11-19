<?php
    $AUTH_COOKIE_KEY = "is_auth";
    $AUTHORIZED_VAL = "1";
    $NOT_AUTHORIZED_VAL = "0";

    if ($_COOKIE[$AUTH_COOKIE_KEY] != $AUTHORIZED_VAL) {
        header('Location: http://expert-anton/auth-normal-sign-in.php');
    }
?>