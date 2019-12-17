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
 * @param type $user
 * @return 
 */
function publish($message, $linkImg, $user) {

	$errorMessage = '';
	if($message == '') {
		$errorMessage = "Ecrivez un message."
	}

	if($errorMessage == '') {
		try {
			$date = date("Y-m-d");
			$stmt = $dbh->prepare('INSERT INTO articles (ref_user, link_img, description, date_publication) VALUES (:ref_user, :link_img, :description, :date_publication)');
            $stmt->execute(array(
                ':ref_user' => $ref_user,
                ':link_img' => $link_img,
                ':description' => $description,
                ':date_publication' => $date_publication
            ));
            $errorMessage = "Succès."
        } catch(PDOException $e) {
			$errorMessage = $e->getMessage();
        }
    }
    
    return $errorMessage;

}

/**
 * 
 * @param type $nbPosts
 * @return 
 */
function fetchArticles($nbPosts) {

	$errorMessage = '';

	if($errorMessage == '') {
		try {
			$stmt = $dbh->prepare('SELECT * FROM articles LIMIT :nbPosts');
            $stmt->execute(array(
                ':nbPosts' => $nbPosts
            ));
            $data = $stmt->fetchAll();
            if($data == false){
                $errorMessage = "Erreur";
            } else {
                return $data;
            }
        } catch(PDOException $e) {
			$errorMessage = $e->getMessage();
			return $errorMessage;
        }
    }

}

/**
 * 
 * @param type $user
 * @param type $idArticle
 * @return 
 */
function like($user, $idArticle) {

	$errorMessage = '';

	if($errorMessage == '') {
		try {
			$date = date("Y-m-d");
			$stmt = $dbh->prepare('INSERT INTO likes (ref_user, ref_article, date_like) VALUES (:ref_user, :ref_article, :date_like)');
            $stmt->execute(array(
                ':ref_user' => $user,
                ':ref_article' => $idArticle,
                ':date_like' => $date
            ));
            $errorMessage = "Succès."
        } catch(PDOException $e) {
			$errorMessage = $e->getMessage();
        }
    }
    
    return $errorMessage;

}

/**
 * 
 * @param type $idArticle
 * @return 
 */
function getLikes($idArticle) {

	$errorMessage = '';

	if($errorMessage == '') {
		try {
			$stmt = $dbh->prepare('SELECT COUNT(*) FROM likes WHERE ref_article = :ref_article');
            $stmt->execute(array(
                ':ref_article' => $idArticle
            ));
            $data = $stmt->fetchAll();
            if($data == false){
                $errorMessage = "Erreur";
            } else {
                $errorMessage = $data;
            }
        } catch(PDOException $e) {
			$errorMessage = $e->getMessage();
        }
    }
    
    return $errorMessage;

}