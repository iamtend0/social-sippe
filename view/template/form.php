<?php
    $pedro = 'Pedro le beauf';
    if (isset($_POST['submit']) && !empty($_POST['post'])) {
        require_once 'model/Articles.php';
        $description = $_POST['post'];
        echo $description;
        $linkImg = null;
        $user = 1;
        $article = new Articles();
        // $article->publish($description, $linkImg, $user);
		// require 'view/template/home.php';
	}

	if (isset($_POST['id'])) {
		$nbPosts = $_POST['id'];
		echo $nbPosts;
	}
?>

<div class="card">
	<div class="card-header">
		<h1 class="text-center">Bonjour <?= $pedro; ?></h1>
	</div>
	<div class="card-body">
		<div id="form1">
			<form action="" method="POST">
				<div class="form-group">
					<textarea class="form-control" name="post" id="post" placeholder="Quoi de neuf ?" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label for="file">Ajouter une image</label>
					<input type="file" class="form-control-file" id="file">
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="Poster">
			</form>
		</div>
		<hr>
		<?php
            include "article.php"
        ?>
	</div>

</div>