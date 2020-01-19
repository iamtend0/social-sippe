<?php
    require_once 'model/Articles.php';
    $article = new Articles();
    
    $nbPosts = '10';
    if (isset($_POST['option_value'])) {
        $nbPosts = $_POST['option_value'];
    }
    $options = array('images', 'messages');
    if (!empty($_POST['optionsChecked'])) {
        $options = $_POST['optionsChecked'];
    }
    $comments = "sans";
    if (isset($_POST['comments'])) {
        $comments = $_POST['comments'];
    }

    $articles = $article->fetchArticles($nbPosts, $options, $comments);
    if ($articles != 'Ne pas afficher') {
        while ($data = $articles->fetch()) {
            ?>
            <div id="article<?= $data['id_article']; ?>">
                <div class="username"><?= $data['prenom'] . " " . $data['nom']; ?></div>
                <div class="date"><?= $data['date_publication']; ?></div>
                <?php
                    if ($data['link_img'] != null) {
                        ?>
                        <div class="image">
                            <img src="<?= $data['link_img']; ?>" alt="Smiley face" height="150">
                        </div>
                <?php
                    } ?>
                <div class="content"><?= $data['description']; ?></div>
                <form>
                    <div>
                        <div class="aimer" name="aimer">
                        <?php
                            $classname = "";
                            ($data['nb_likes'] == 0) ? $classname = "far fa-heart" : $classname = "fas fa-heart";
                        ?>
                        <i class="<?= $classname ?>"></i>
                        </div>
                        <div id="counter"><?= $data['nb_likes']; ?></div>
                        <button type="button" class="btn btn-primary">Commenter</button>
                    </div>
                    <textarea class="form-control" class="comment" placeholder="Votre commentaire ?" rows="3"></textarea>
                </form>
            </div>
        <?php
        }
    }

?>