<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>My Blog - Sign Up</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .anim {
            display: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".anim").fadeIn(500);
        });
    </script>
</head>

<body>

<?php require ROOT . '/templates/navbar.php' ?>

<div class="container">
    <div style="margin-right: 20%; margin-left: 20%" class="panel panel-default anim">
        <div class="panel-heading">
            <h3>Sign Up</h3>
        </div>

        <div class="panel-body">
            <?php require ROOT . '/templates/sign_up_form.php' ?>
        </div>
    </div>
</div>

</body>

</html>
