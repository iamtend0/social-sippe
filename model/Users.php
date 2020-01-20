<?php

class Users {

    private $id_user;
    private $email;
    private $name;
    private $firstname;

    /**
     * Users constructor.
     * @param $email
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }




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
     *
     * @param type $email
     * @param type $password
     * @return "ok" if log done
     */
    function logIn($email, $password) {

        $dbh = $this->dbConnect();

        $errMsg = "";
        if($email == '')
            $errMsg = 'Veuillez entrer un email';
        if($password == '')
            $errMsg = 'Veuillez entrer un mot de passe';

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
                        $this->setIdUser($data['id_user']);
                        $this->setEmail($data['email']);
                        $this->setName($data['nom']);
                        $this->setFirstname($data['prenom']);
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


    function signUp($email, $nom, $prenom, $password) {

        $dbh = $this->dbConnect();

        $errMsg = '';
        // Get data from FROM
        if ($nom == '')
            $errMsg = 'Entrez un nom';
        if ($prenom == '')
            $errMsg = 'Entrez un prénom';
        if ($password == '')
            $errMsg = 'Entrez un mot de passe';
        if ($email == '')
            $errMsg = 'Entrez une adresse email';

        if ($errMsg == '') {

            // search if email already exists
            $chk = $dbh->prepare("SELECT * FROM users WHERE email =  :email");
            $chk->bindParam(':email', $email);
            $chk->execute();


            if($chk->rowCount() > 0) {
                //user exists
                $errMsg = "Compte déjà existant.";
            } else {
                try {
                    $stmt = $dbh->prepare('INSERT INTO users (email, nom, prenom, password) '
                        . 'VALUES (:email, :nom, :prenom, :password)');
                    $stmt->execute(array(
                        ':email' => $email,
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':password' => $password
                    ));
                    $errMsg = "ok";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

        }


        return $errMsg;
    }
}






