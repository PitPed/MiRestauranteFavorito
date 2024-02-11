<?php
include_once 'Models/Usuario.php';
include_once 'Models/Plato.php';
include_once "connection.php";
$fromController = true;

session_start();
if (isset($_POST['CerrarSesion'])) {
    unset($_SESSION['user']);
}
if (isset($_POST['end']) && isset($_SESSION['cart'])) {
    include('Views/ticket.php');
} else if (isset($_SESSION['user'])) {
    include('Views/menu.php');
} else {
    if (isset($_POST['action']) && $_POST['action'] == 'Login') {
        $user = new Usuario($_POST['user'], $_POST['password']);
        if ($user->isLogged()) {
            $_SESSION['user'] = $user;
            header("Refresh:0");
        } else {
            $incorrect = true;
            include('Views/login.php');
        }
    } else {
        include('Views/login.php');
    }
}


?>