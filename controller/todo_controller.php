<?php

    // require_once "model/todo_model.php";

    // VIEWS
    function sign_in() {
        // session_start();

        if (!(isset($_SESSION["logged"]) or isset($_SESSION["username"]))) {
            require "views/login.php";
        } else {
            header("location: index.php?action=login");
            exit();
        }
    }

    function show_todos() {
        // This $user_todos Is Used In The View In Order To Loop On Todos To Fill The Table
        $user_todos = user_todos();

        $username = retrieve_users_by_username($_SESSION["username"]);
        $username = $username["username"];
        $username = strtoupper($username);

        require "views/todos.php";
    }

    function user_todos() {
        // session_start();
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            return get_todos($username);
        } else {
            header("location: index.php?action=401");
            exit();
        }
    }

    function new_todo() {
        // session_start();
        if (isset($_POST["todo"])) {
            $todo = filter_var($_POST["todo"], FILTER_SANITIZE_SPECIAL_CHARS);
            $todo = htmlspecialchars($todo);
            $todo = trim($todo);
            $todo = ucfirst($todo);
            if (!empty($todo)) {
                $username = $_SESSION["username"];
                ajouter_todo($todo, $username);
            }
        }

        header("location: index.php?action=afficher");
        exit();
    }

    function authentification() {
        if (isset($_POST["username"]) and isset($_POST["password"])) {
            $username = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
            $username = htmlspecialchars($username);
            $username = trim($username);
            $password = htmlspecialchars($_POST["password"]);
            
            if($username != "" and $password != "") {
                $user = retrieve_users_by_username($username);

                if (!empty($user)) {
                    if ($user["username"] == $username and password_verify($password, $user["password"])) {
                        // session_start();
                        $_SESSION["logged"] = "true";
                        $_SESSION["username"] = $username;
                        
                        echo '{"stat": "success", "message": "You Are Logged"}';
                        
                        // Used to print out feedback alerts in the sign in page
                    } else {
                        echo '{"stat": "error", "message": "Wrong Email Or Passowrd!!!"}';
                        exit();
                    }
                } else {
                    echo '{"stat": "error", "message": "Username Does not Exists!!!"}';
                    exit();
                }
            } else {
                echo '{"stat": "error", "message": "Please Fill Out All The Fields!!!"}';
                exit();
            }
            
        } else {
            // Missing Up With URL
            header("location: index.php?action=401");
            exit();
        }
    }

    function update() {
        // session_start();
        if (isset($_SESSION["logged"]) and isset($_SESSION["username"])) {
            if (isset($_POST["todo"]) and isset($_POST["todo_id"])) {
                $id = filter_var($_POST["todo_id"], FILTER_SANITIZE_NUMBER_INT);
                $id = htmlspecialchars($id );
                $id = trim($id );
                $todo = filter_var($_POST["todo"], FILTER_SANITIZE_SPECIAL_CHARS);
                $todo = htmlspecialchars($todo);
                $todo = trim($todo);

                if ($id && $todo) {
                    update_todo($id, $todo);
                    echo "GOOD";
                } else echo "Fields Required";

            } else echo "Not Allowed";
        } else {
            echo "Forbidden";
        }
    }

    function supprimer() {
        // session_start();
        if (isset($_SESSION["logged"]) and isset($_SESSION["username"])) {
            if (isset($_POST["action"]) and isset($_POST["id"])) {
                $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
                $id = htmlspecialchars(trim($id));
                if ($_POST["action"] == "supprimer") {
                    drop_todo($id);
                    echo "success";
                }
            }
        } else {
            header("location: index.php?action=403");
            exit();
        }

        // header("location: index.php?action=afficher");
        // exit();
    }

    function deconnection() {
        // session_start();
        if (isset($_SESSION["logged"]) and isset($_SESSION["username"])) {
            session_unset();
            session_destroy();
        } else {
            header("location: index.php?action=403");
            exit();
        }

        header("location: index.php?action=login");
        exit();
    }


    // ! ERRORS PAGES VIEWS
    function forbidden() {
        require "views/errors/403.php";
    }

    function not_found() {
        require "views/errors/404.php";
    }
    
    function unauthorized() {
        require "views/errors/401.php";
    }
?>