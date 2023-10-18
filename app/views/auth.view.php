<?php

class AuthView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }
    function showError($error) {
        require './templates/error.phtml';
    }
}