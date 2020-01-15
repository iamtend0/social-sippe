<?php
    require_once 'model/Articles.php';
    $article = new Articles();
    
	$nbPosts = "1";
	if (isset($_POST['option_value'])) {
        $nbPosts = $_POST['option_value'];
        echo "titi";
    }

    $articles = $article->fetchArticles($nbPosts);
    while ($data = $articles->fetch()) {
    ?>
        <div id="article<?php echo $data['id_article']; ?>">
            <div class="username"><?php echo $data['ref_user']; ?></div>
            <div class="date"><?php echo $data['date_publication']; ?></div>
            <div class="content"><?php echo $data['description']; ?></div>
            <form>
                <div>
                    <button type="button" name="aimer" class="btn btn-primary">Aimer</button>
                    <div id="counter"><?php echo $data['nb_likes']; ?></div>
                    <button type="button" class="btn btn-primary">Commenter</button>
                </div>
                <textarea class="form-control" class="comment" placeholder="Votre commentaire ?" rows="3"></textarea>
            </form>
        </div>
    <?php
    }

?>