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
     *
     * @return
     */
    public function fetchArticles($nbPosts)
    {
        $errorMessage = '';

        if ($errorMessage == '') {
            try {
                $dbh = $this->dbConnect();

                $stmt = $dbh->prepare('SELECT id_article, articles.ref_user, link_img, description, date_publication, (SELECT COUNT(*) FROM likes WHERE ref_article = id_article) as nb_likes FROM articles LEFT JOIN likes ON id_article = ref_article LIMIT '.$nbPosts.'');
                $stmt->execute();
                $errorMessage = $stmt;
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
                $errorMessage = "Erreur";
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
                $stmt = $dbh->prepare('INSERT INTO likes (ref_user, ref_article, date_like) VALUES (:ref_user, :ref_article, :date_like)');
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

}
