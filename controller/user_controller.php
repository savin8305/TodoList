<?php

    class User {

        public static function register_layout() {
            require "views/register.php";
        }

        public static function register() {
            if ($_SERVER["REQUEST_METHOD"] != "POST") {
                echo "Forbidden";
                exit;
            }

            if (!(isset($_POST["username"]) or isset($_POST["email"]) or isset($_POST["password"]) or isset($_POST["confirm_password"]))) {
                echo "Forbidden";
                exit;
            }

            $username = trim($_POST["username"]);
            $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);

            $email = trim($_POST["email"]);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);

            $confirm_password = filter_var($_POST["confirm_password"], FILTER_SANITIZE_SPECIAL_CHARS);


            if (empty($username) or empty($email) or empty($password) or empty($confirm_password)) {
                echo '{"status": "error", "message": "Fields Cannot Be Empty!!!"}';
                exit;
            }

            if (retrieve_users_by_username($username)) {
                echo '{"status": "error", "message": "Username Already Exists!!!"}';
                exit;
            }

            if (retrieve_users_by_email($email)) {
                echo '{"status": "error", "message": "Email Already Exists!!!"}';
                exit;
            }

            if ($password != $confirm_password) {
                echo '{"status": "error", "message": "Wrong Password Confirmation!!!"}';
                exit;
            }

            // Everything Is Valid
            $password = password_hash($password, PASSWORD_DEFAULT);
            register_user($username, $password, $email);
            $_SESSION["success"] = "Account Has Been Created!!!";
            echo '{"status": "success", "message": "You Have Been Registered Successfully!!!"}';
            exit;

        }

    }

?>