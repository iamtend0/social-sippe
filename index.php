<?php
include 'model/*';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppController.
 *
 * @author apuget29
 */
/* if (!isset($_GET['page'])) {
    require 'view/template/home.php';

    
if ( !isset($_SESSION['nom'])) {
    require 'view/template/signin.php';
    exit();
} else if ( !isset($_GET['page']) ) {
    require 'view/template/home.php';
    exit();
}

switch ($_GET['page']) {
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
} */

// Publier un article
if (isset($_POST['submit'])) {
    if (empty($_POST['post'])) {
        $messagePost = "Empty message";
        $vars = array("messagePost");
        compact('vars');
        require 'view/template/home.php';
    } else {
        require_once 'model/Articles.php';
        $description = $_POST['post'];
        $user = 1;
        // $user = $_SESSION['id_user'];
        $article = new Articles();
        $linkImg = $article->upload();
        $article->publish($description, $linkImg, $user);
        require 'view/template/home.php';
    }
}

// Like
else if (isset($_POST['like'])) {
    require_once 'model/Articles.php';
    $user = 2;
    // $user = $_SESSION['id_user'];
    $idArticle = $_POST['like'];
    $article = new Articles();
    $article->like($user, $idArticle);
    require 'view/template/home.php';
}

// Remove like
else if (isset($_POST['removeLike'])) {
    require_once 'model/Articles.php';
    $user = 2;
    // $user = $_SESSION['id_user'];
    $idArticle = $_POST['removeLike'];
    $article = new Articles();
    $article->removeLike($user, $idArticle);
    require 'view/template/home.php';
}

// Nombre de posts
else if (isset($_POST['option_value'])) {
    require 'view/template/home.php';
}

// Options images, message
else if (isset($_POST['optionsChecked'])) {
    require 'view/template/home.php';
}

// Avec ou sans commentaires
else if (isset($_POST['comments'])) {
    require 'view/template/home.php';
}

else {
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


