<?php
include 'model/*';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of AppController
 *
 * @author apuget29
 */

    
if ( !isset($_SESSION['nom'])) {
    require 'view/template/signin.php';
    exit();
} else if ( !isset($_GET['page']) ) {
    require 'view/template/home.php';
    exit();
}

switch($_GET['page']) {
    case 'new-article':
    break;
    case 'home':
        require 'view/template/home.php'; 
        break;
    case 'comment':
        require 'view/template/home.php';
        break;
    case 'login':
        login();
        break;
    default:
        require 'view/template/home.php';
}


function login() {
    if(!isset($_POST['email']) || !isset($_POST['password'])) {
        $err = "Veuillez renseigner votre email et mot de passe";
        require 'view/template/signin.php';
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $msg = Users::logIn($email, $password);
    if($msg != "ok") {
        $err = $msg;
        require 'view/template/signin.php';
    } else {
        $nom = $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        require 'view/template/home.php';
    }
}


