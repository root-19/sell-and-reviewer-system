<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($this->user->register($username, $email, $password)) {
                header("Location: /login");
                exit();
            } else {
                echo "Registration failed.";
            }
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($this->user->login($email, $password)) {
                header("Location: /dashboard");
                exit();
            } else {
                echo "Invalid credentials.";
            }
        }
    }
}
