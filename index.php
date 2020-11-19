<?php
    include 'auth_checker.php';
    include 'DB.php';

    if ($_COOKIE["is_auth"] == 1) {
        if ( $_COOKIE["is_admin"] == 1) {
            header('Location: http://expert-anton/admin.php');
        } else {
            header('Location: http://expert-anton/expert.php');
        }
    }
?>
