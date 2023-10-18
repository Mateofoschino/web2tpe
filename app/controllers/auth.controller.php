<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';

class AuthController
{
    private $view;
    private $model;

    function __construct(){
        $this->view = new AuthView();
        $this->model = new UserModel();
    }

    public function showLogin(){    
        $this->view->showLogin();
    }


    public function auth(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)) {
            $this->view->showLogin('Falta usuario o contraseña');
            return;
        }

        $user = $this->model->getByUsername($username);
        
        
        if ($user /*&& password_verify($password, ($user->password))*/) {
            AuthHelper::login($user);
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin("Usuario invalido");
            var_dump($user->password);
            var_dump($password);
        }
    }

    public function logout(){
        AuthHelper::init();
        if (isset($_SESSION['USER_ID'])) {
            AuthHelper::logout();
            header('Location: ' . BASE_URL);
        }
    }

    
}