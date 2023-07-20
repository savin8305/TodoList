<?php
    session_start();
    require "model/todo_model.php";
    require_once "model/users_model.php";
    require "controller/todo_controller.php";
    require "controller/user_controller.php";


    if (isset($_REQUEST["action"])) {
        $route = $_REQUEST["action"];

        switch ($route) {
            case "afficher":
                show_todos();
                break;

            case "login":
                sign_in();
                break;

            case "ajouter":
                new_todo();
                break;

            case "update":
                update();
                break;

            case "logout":
                deconnection();
                break;

            case "authentification":
                authentification();
                break;

            case "supprimer":
                supprimer();
                break;

            case "register":
                User::register();
                break;

            case "sign_up":
                User::register_layout();
                break;

            case "401":
                unauthorized();
                break;

            case "403":
                forbidden();
                break;

            default:
                not_found();
        }
    } else {
        sign_in();
    }