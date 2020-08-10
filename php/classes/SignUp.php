<?php

namespace App;

use Database;

include './config/db.php';

class SignUp
{
    function __construct()
    {
        $this->conn = \Database::connect();
        $this->errors = [];
        $this->success_msg = '';
    }

    public function login()
    {
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $this->checkFormValidation($email, $password);

            if (empty($this->errors)) {
                $_SESSION['registered'] = true;
                $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
                header("Location: /");
                exit();
            }
        }
    }

    public function checkFormValidation($email, $password)
    {
        if (empty($email)) {
            $this->errors['email'] = 'Email is required!';
        }

        if (empty($password)) {
            $this->errors['password'] = 'Password is required!';
        }

        if (!$this->checkEmail($email) || !$this->checkPassword($email, $password)) {
            $this->errors['incorrect'] = 'Username or password is incorrect. Try again!';
        }
    }

    public function checkEmail($email)
    {
        return Database::checkUserEmail($email);
    }

    public function checkPassword($email, $password)
    {
        return password_verify($password, Database::checkUserPassword($email, $password));
    }

    public function showError($error)
    {
        if (isset($this->errors[$error])) {
            echo '<div class="alert alert-danger" role="alert">' . $this->errors[$error] . '</div> ';
        }
    }
}
