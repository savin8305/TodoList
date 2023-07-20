<?php

    function connection() {
        $username = "root";
        $password = "";
        $host = "localhost";
        $db_name = "todos";
        $dsn = "mysql:host=$host;dbname=$db_name";

        try {
            return new PDO($dsn, $username, $password);
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
        
    }

    function get_todos($username) {
        $db_connection = connection();

        $statment = $db_connection->prepare("SELECT * FROM todo WHERE user_username LIKE :username ORDER BY id DESC");

        $statment->execute([":username" => $username]);

        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    function ajouter_todo($todo, $username) {
        $db_connection = connection();

        $statment = $db_connection->prepare("INSERT INTO todo VALUES(NULL, :todo, :username)");

        $statment->execute([":todo" => $todo, ":username" => $username]);
    }

    function update_todo($todo_id, $todo_content) {
        $db_connection = connection();

        $statment = $db_connection->prepare("UPDATE todo SET todo = :todo WHERE id = :id");

        $statment->execute([":id" => $todo_id, ":todo" => $todo_content]);
    }

    function supprimer_todo($todo_id) {
        $db_connection = connection();

        $statment = $db_connection->prepare("DELETE FROM todo WHERE id = :id");

        $statment->execute([":id" => $todo_id]);
    }

    function drop_todo($id) {
        $db_connection = connection();

        $statment = $db_connection->prepare("DELETE FROM todo WHERE id = :id");
        $statment->execute([":id" => $id]);
    }
?>