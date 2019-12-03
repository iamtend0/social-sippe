<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</head>
	<body>
		<div id="formulaire">
			<div id="form1">
				<h1>Bonjour</h1>
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
	</body>
</html>

