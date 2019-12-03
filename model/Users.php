<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$servername = "localhost";
$dbname = "social_sippe";
$username = "root";
$password = "";

$dbh = new PDO('mysql:host='.$servername.';dbname='.$social_sippe, 
                        $username, $password);


/**
 * 
 * @param type $email
 * @param type $password
 * @return "ok" if log done
 */
function logIn($email, $password) {
    
    $errMsg = "";
    if($username == '')
        $errMsg = 'Enter username';
    if($password == '')
        $errMsg = 'Enter password';
    
    if($errMsg == '') {
	try {
                $stmt = $dbh->prepare('SELECT * FROM users WHERE email = :email');
                $stmt->execute(array(
                    ':email' => $email
                ));
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                if($data == false){
                    $errMsg = "Utilisateur non trouvé.";
                } else {
                    if($password == $data['password']) {
                        session_start();
                        $_SESSION['nom'] = $data['nom'];
                        $_SESSION['prenom'] = $data['prenom'];
                        $_SESSION['logged'] = true;
                        $errMsg = "ok";
                    } else {
                        $errMsg = 'Mot de passe incorrect.';
                    }
                }
            } catch(PDOException $e) {
		$errMsg = $e->getMessage();
            }
    }
    
    return $errMsg;
}

/**
 * LOG OUT 
 */
function logOut() {
    session_destroy();
}