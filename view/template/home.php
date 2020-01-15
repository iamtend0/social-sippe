<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AntiSocial SocialNetwork</title>
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="view/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
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
                    include "menu.php"
                ?>
            </div>
            <div class="col-9 core">
                <?php
                    include "form.php"
                ?>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#pet-select").change(function(){
            var selected_option_value=$("#pet-select option:selected").val();
            console.log(selected_option_value);

            $.post("index.php", {option_value: selected_option_value}, function(data){
                console.log(data);
            });
            /* $.ajax({
                type: "POST",
                data: {option_value: selected_option_value}
            }).done(function(msg) {
                console.log(msg);
            }); */
        });
    });

    $('button[name=aimer]').click(function() {
        var idArticle = $("button[name=aimer]").closest("div[id^=article]").attr("id").replace("article","");
        console.log(idArticle);
        $.post("index.php", {id: idArticle}, function(data){
                console.log(data);
            });
    });
</script>
</html>
