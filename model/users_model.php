<?php

    function retrieve_users_by_username($username) {
        $db_connection = connection();

        $statment = $db_connection->prepare("SELECT * FROM users WHERE username LIKE :username LIMIT 1");
        $statment->execute([":username" => $username]);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    function retrieve_users_by_email($email) {
        $db_connection = connection();

        $statment = $db_connection->prepare("SELECT * FROM users WHERE email LIKE :email LIMIT 1");
        $statment->execute([":email" => $email]);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    function register_user($username, $password, $email) {
        $db_connection = connection();

        $statment = $db_connection->prepare("INSERT INTO users VALUES (NULL, :username, :user_password, :email)");
        $statment->execute([
            ":username" => $username,
            ":user_password" => $password,
            ":email" => $email
        ]);
    }

?>