<?php

class AuthHelper
{
    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($username) {
        AuthHelper::init();
        $_SESSION['USER_ID'] = $username->user_ID;
        $_SESSION['USER_EMAIL'] = $username->username;
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {
        AuthHelper::init();
        return (isset($_SESSION['USER_ID']));
    }
}