<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AntiSocial SocialNetwork</title>
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="view/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 sidemenu">
                <?php
                    include 'menu.php';
                ?>
            </div>
            <div class="col-9 core">
                <?php
                    include 'form.php';
                ?>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){

        // Set variables in localstorage
        localStorage.setItem('nbPosts', $('#pet-select option:selected').val());
        var optionsChecked = [];
        $('input[type="checkbox"]:checked').each(function(index) {
            optionsChecked.push($(this).val());
        });
        localStorage.setItem('optionsChecked', JSON.stringify(optionsChecked));
        localStorage.setItem('comments', $('input[type="radio"]:checked').val());
        
        // Afficher message
        var messagePost = "<?php echo $message; ?>";
        if (messagePost == "Empty message") {
            console.log(messagePost);
            $('.col-9 .card-body').prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert">Message vide !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }

        // Aimer un post
        $(document).on('click', 'div.aimer .far', function() {
            var idArticle = $(this).closest('div[id^=article]').attr('id').replace('article','');
            console.log(idArticle);
            $.post('index.php', {like: idArticle, option_value: localStorage.getItem('nbPosts'), optionsChecked: JSON.parse(localStorage.getItem('optionsChecked')), comments: localStorage.getItem('comments')}, function(data){
                $('#articles').remove();
                $('.col-9 .card-body').append($(data).find('#articles'));
            });
        });

        // Retirer son j'aime
        $(document).on('click', 'div.aimer .fas', function() {
            var idArticle = $(this).closest('div[id^=article]').attr('id').replace('article','');
            console.log(idArticle);
            $.post('index.php', {removeLike: idArticle, option_value: localStorage.getItem('nbPosts'), optionsChecked: JSON.parse(localStorage.getItem('optionsChecked')), comments: localStorage.getItem('comments')}, function(data){
                $('#articles').remove();
                $('.col-9 .card-body').append($(data).find('#articles'));
            });
        });

        // Sélectionner nb de posts
        $('#pet-select').change(function(){
            var selected_option_value=$('#pet-select option:selected').val();
            console.log(selected_option_value);
            localStorage.setItem('nbPosts', $('#pet-select option:selected').val());
            $.post('index.php', {option_value: localStorage.getItem('nbPosts'), optionsChecked: JSON.parse(localStorage.getItem('optionsChecked')), comments: localStorage.getItem('comments')}, function(data){
                $('#articles').remove();
                $('.col-9 .card-body').append($(data).find('#articles'));
            });
        });

        // Sélectionner le type d'article
        var options = JSON.parse(localStorage.getItem("optionsChecked"));
        console.log(options);
        $('input[type="checkbox"]').click(function(){
            if ($(this).prop("checked") == true) {
                if ($.inArray("empty", options) == 0) {
                    options.splice( $.inArray("empty", options), 1 );
                    options.push($(this).val());
                } else {
                    options.push($(this).val());
                }
            }
            else if($(this).prop("checked") == false){
                options.splice( $.inArray($(this).val(), options), 1 );
                if (options.length === 0) {
                    options.push("empty");
                }
            }
            console.log(options);
            localStorage.setItem('optionsChecked', JSON.stringify(options));
            $.post('index.php', {option_value: localStorage.getItem('nbPosts'), optionsChecked: JSON.parse(localStorage.getItem('optionsChecked')), comments: localStorage.getItem('comments')}, function(data){
                $('#articles').remove();
                $('.col-9 .card-body').append($(data).find('#articles'));
            });
        });

        // Choisir les articles avec ou sans commentaires
        $('input[type="radio"]').click(function(){
            if ($(this).val() == "avec") {
                $("#comments").css("display", "block");
            } else {
                $("#comments").css("display", "none");
            }
        });

    });
</script>
</body>
</html>
