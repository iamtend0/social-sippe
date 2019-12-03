<?php
	$pedro="Pedro le beauf";
?>

<div class="card">
	<div class="card-header">
		<h1 class="text-center">Bonjour <?= $pedro ?></h1>
	</div>
	<div class="card-body">
		<div id="form1">
			<form>
				<div class="form-group">
					<textarea class="form-control" id="post" placeholder="Quoi de neuf ?" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label for="file">Ajouter une image</label>
					<input type="file" class="form-control-file" id="file">
				</div>
				<button type="submit" class="btn btn-primary">Poster</button>
			</form>
		</div>
		<hr>
		<div id="form2">
			<div id="username">prenom.nom</div>
			<div id="date">2019-12-03</div>
			<div id="post">Bonjour à tous</div>
			<form>
				<div>
					<button type="button" class="btn btn-primary">Aimer</button>
					<div id="counter">0</div>
					<button type="button" class="btn btn-primary">Commenter</button>
				</div>
				<textarea class="form-control" id="comment" placeholder="Votre commentaire ?" rows="3"></textarea>
			</form>
		</div>
	</div>

</div>