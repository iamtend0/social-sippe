<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Articles
{
    private function dbConnect()
    {
        $servername = 'localhost';
        $dbname = 'social_sippe';
        $username = 'root';
        $password = '';
        $dbh = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);

        return $dbh;
    }

    /**
     * @param type $message
     * @param type $linkImg
     * @param type $user
     *
     * @return
     */
    public function publish($description, $linkImg, $user)
    {
        $errorMessage = '';
        if ($description == '') {
            $errorMessage = 'Ecrivez un message.';
        }

        if ($errorMessage == '') {
            try {
                $dbh = $this->dbConnect();

                $date = date('Y-m-d');
                $stmt = $dbh->prepare('INSERT INTO articles (ref_user, link_img, description, date_publication) VALUES (:ref_user, :link_img, :description, :date_publication)');
                $stmt->execute(array(
                    ':ref_user' => $user,
                    ':link_img' => $linkImg,
                    ':description' => $description,
                    ':date_publication' => $date,
                ));
                $errorMessage = 'Succès.';
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        return $errorMessage;
    }

    /**
     * @param type $nbPosts
     * @param type $options
     * @param type $comments
     *
     * @return
     */
    public function fetchArticles($nbPosts, $options)
    {
        $errorMessage = '';

        if ($errorMessage == '') {
            try {
                $dbh = $this->dbConnect();

                $sql = "";
                $text = "";

                if (in_array("images", $options) && (sizeof($options) == 1)) {
                    $sql = 'SELECT nom, prenom, id_article, articles.ref_user, link_img, articles.description, date_publication, (SELECT COUNT(*) FROM likes WHERE ref_article = id_article) as nb_likes FROM articles LEFT JOIN likes ON articles.id_article = likes.ref_article INNER JOIN users WHERE articles.ref_user = id_user AND link_img IS NOT NULL ORDER BY id_article DESC LIMIT '.$nbPosts.'';
                } else if (in_array("messages", $options) && (sizeof($options) == 1)) {
                    $sql = 'SELECT nom, prenom, id_article, articles.ref_user, link_img, articles.description, date_publication, (SELECT COUNT(*) FROM likes WHERE ref_article = id_article) as nb_likes FROM articles LEFT JOIN likes ON articles.id_article = likes.ref_article INNER JOIN users WHERE articles.ref_user = id_user AND link_img IS NULL ORDER BY id_article DESC LIMIT '.$nbPosts.'';
                } else if (in_array("empty", $options)) {
                    $sql = "";
                } else {
                    $sql = 'SELECT nom, prenom, id_article, articles.ref_user, link_img, articles.description, date_publication, (SELECT COUNT(*) FROM likes WHERE ref_article = id_article) as nb_likes FROM articles LEFT JOIN likes ON articles.id_article = likes.ref_article INNER JOIN users WHERE articles.ref_user = id_user ORDER BY id_article DESC LIMIT '.$nbPosts;
                }

                if ($sql != "") {
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();
                    $errorMessage = $stmt;
                } else {
                    $errorMessage = 'Ne pas afficher';
                }
                
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
                $errorMessage = 'Erreur';
            }
        }

        return $errorMessage;
    }

    /**
     * @param type $user
     * @param type $idArticle
     *
     * @return
     */
    public function like($user, $idArticle)
    {
        $errorMessage = '';

        if ($errorMessage == '') {
            try {
                $dbh = $this->dbConnect();

                $date = date('Y-m-d');
                $stmt = $dbh->prepare('INSERT INTO likes (ref_user, ref_article, date_like) SELECT :ref_user, :ref_article, :date_like WHERE NOT EXISTS (SELECT * FROM likes WHERE ref_user = :ref_user AND ref_article = :ref_article)');
                $stmt->execute(array(
                    ':ref_user' => $user,
                    ':ref_article' => $idArticle,
                    ':date_like' => $date,
                ));
                $errorMessage = 'Succès.';
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        return $errorMessage;
    }

    /**
     * @param type $user
     * @param type $idArticle
     *
     * @return
     */
    public function removeLike($user, $idArticle)
    {
        $errorMessage = '';

        if ($errorMessage == '') {
            try {
                $dbh = $this->dbConnect();

                $date = date('Y-m-d');
                $stmt = $dbh->prepare('DELETE FROM likes WHERE ref_user = :ref_user AND ref_article = :ref_article');
                $stmt->execute(array(
                    ':ref_user' => $user,
                    ':ref_article' => $idArticle,
                ));
                $errorMessage = 'Succès.';
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        return $errorMessage;
    }

    /**
     * @return
     */
    public function upload()
    {
        $errorMessage = '';

        $currentDir = getcwd();
        $uploadDirectory = '/img/';

        $errors = []; // Store all foreseen and unforseen errors here

        $fileExtensions = ['jpeg', 'jpg', 'png']; // Get all the file extensions

        $fileName = $_FILES['imgToUpload']['name'];
        $fileSize = $_FILES['imgToUpload']['size'];
        $fileTmpName = $_FILES['imgToUpload']['tmp_name'];
        $fileType = $_FILES['imgToUpload']['type'];
        $tmp = explode('.', $fileName);
        $fileExtension = strtolower(end($tmp));

        $uploadPath = $currentDir.$uploadDirectory.basename($fileName);

        if (!in_array($fileExtension, $fileExtensions)) {
            $errors[] = 'This file extension is not allowed. Please upload a JPEG or PNG file';
        }

        if ($fileSize > 2000000) {
            $errors[] = 'This file is more than 2MB. Sorry, it has to be less than or equal to 2MB';
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
                // echo "The file " . basename($fileName) . " has been uploaded";
                $errorMessage = '/social-sippe'.$uploadDirectory.basename($fileName);
            } else {
                // echo "An error occurred somewhere. Try again or contact the admin";
                $errorMessage = null;
            }
        } else {
            foreach ($errors as $error) {
                // echo $error . "These are the errors" . "\n";
                $errorMessage = null;
            }
        }

        return $errorMessage;
    }

    public function newComment($user, $idArticle, $description) {
        $errorMessage = '';

        if($description == '') {
            $errorMessage = 'Commentaire inexistant';
        }

        if ($errorMessage == '') {
            try {
                $dbh = $this->dbConnect();

                $date = date('Y-m-d');
                $stmt = $dbh->prepare('INSERT INTO comments (ref_user, ref_article, description) 
                                                VALUES(:ref_user, :ref_article, :description)');
                $stmt->execute(array(
                    ':ref_user' => $user,
                    ':ref_article' => $idArticle,
                    ':description' => $description,
                ));
                $errorMessage = 'Commentaire publié.';
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        return $errorMessage;
    }

    public function displayComments($idArticle)
    {

        try {
            $dbh = $this->dbConnect();

            $sql = 'SELECT * FROM comments, users WHERE ref_article = ' .$idArticle.' AND ref_user = id_user';
            $data = $dbh->query($sql);

            return $data;

        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
        }

        return $errorMessage;
    }

}
