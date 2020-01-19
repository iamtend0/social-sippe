<?php
	$pedro = 'Pedro le beauf';
	/* $firstname = $_SESSION["prenom"];
	$lastname = $_SESSION["nom"]; */
	
	$message = "";
	if (isset($vars)) {
		extract($vars);
		$message = $messagePost;
	}
?>

<div class="card">
	<div class="card-header">
		<h1 class="text-center">Bonjour <!-- <?= $firstname . " " . $lastname ?> --></h1>
	</div>
	<div class="card-body">
		<div id="form">
			<form action="index.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<textarea class="form-control" name="post" id="post" placeholder="Quoi de neuf ?" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label for="file" >Ajouter une image</label>
					<input type="file" class="form-control-file" name="imgToUpload", accept="image/png, image/jpeg">
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="Poster">
			</form>
		</div>
		<hr>
		<div id="articles">
		<?php
            include "article.php"
        ?>
		</div>
	</div>

</div>