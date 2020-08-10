<?php

namespace App;

use Database;

include './config/db.php';

class Registration
{
    function __construct()
    {
        $this->errors = [];
        $this->success_msg = '';
    }

    public function register()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $rpassword = $_POST["rpassword"];

        $this->checkFormValidation($email, $password, $rpassword);

        if (empty($this->errors)) {
            $this->successRegister($email, $password);
            header("Location: /sign_up.php");
        }
    }

    public function checkFormValidation($email, $password, $rpassword)
    {
        if (isset($_POST["submit"])) {

            if (Database::checkUserEmailExist($email)) {
                $this->errors['email'] = 'User with ' . $email . ' email already exist!';
            }

            if (empty($email)) {
                $this->errors['email'] = 'Email is required!';
            }

            if (empty($password)) {
                $this->errors['password'] = 'Password is required!';
            }

            if (empty($rpassword)) {
                $this->errors['rpassword'] = 'Repeated password is required!';
            }

            if ($password != $rpassword) {
                $this->errors['rpassword'] = 'Password mismatch!';
            }
        }
    }

    public function successRegister($email, $password)
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        Database::addUser($email, $password_hash);
        
        $this->success_msg = 'User registered successfully!';
    }

    public function showError($error)
    {
        if (isset($this->errors[$error])) {
            echo '<div class="alert alert-danger" role="alert">' . $this->errors[$error] . '</div> ';
        }
    }
}
