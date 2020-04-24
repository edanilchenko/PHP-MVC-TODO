<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">PHP MVC TODO</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <?php if(!isset($_SESSION['admin'])) :?>
                    <a class="nav-link" id="auth_link" href="#">Авторизоваться</a>
                    <?php else: ?>
                    <a class="nav-link" id="logout_link" href="#">Выйти</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    <form id="auth_form" action="">
        <input type="hidden" name="action" value="auth">
        <input type="text" name="login">
        <input type="password" name="password">
        <input type="submit">
    </form>
    <script>
        $('#logout_link').click(function(){
            $.ajax({
                type: "POST",
                url: "index.php",
                data: { action: "logout" }
            }).done(function( msg ) {
                console.log(msg);
                setTimeout(function(){
                    document.location.href = 'index.php';
                }, 2000);
            });
        });
    </script>