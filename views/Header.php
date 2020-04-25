<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
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
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter">Авторизоваться</button>
                    <?php else: ?>
                    <a class="nav-link" id="logout_link" href="#">Выйти</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Авторизация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="auth_alert" class="alert alert-danger" role="alert" style="display:none;">
                </div>
                <form id="auth_form" action="">
                    <input type="hidden" name="action" value="auth">
                    <div class="form-group mb-2">
                        <input type="text" placeholder="Логин" class="form-control" required name="login">
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" placeholder="Пароль" class="form-control" required name="password">
                    </div>
                    <input type="submit" class="btn btn-primary mb-2" value="Войти">
                </form>
                <script>
                    $('#auth_form').submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "index.php",
                            data: $(e.target).serialize()
                        }).done(function(res){
                            res = JSON.parse(res);
                            if(res.success){
                                document.location.href = 'index.php';
                            }
                            else{
                                $('#auth_alert')[0].innerText = res.message;
                                $('#auth_alert').show();
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    </div>

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