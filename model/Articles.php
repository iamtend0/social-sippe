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
 * @param type $message
 * @param type $linkImg
 * @param type $date
 * @param type $user
 * @return 
 */
function publish($message, $linkImg, $date, $user) {

	$errorMessage = '';
	if($message == '') {
		$errorMessage = "Ecrivez un message"
	}

	if($errMsg == '') {
		
    }

}