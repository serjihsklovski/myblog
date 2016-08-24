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

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">SerjihBlog</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/myblog/">Main</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top:80px">
    <div class="row">
        <div class="col-sm-7 col-md-7 col-md-offset-3">
            <div class="row">
                <div class="col-lg-10 col-md-11 col-sm-2 col-xs-12">
                    <div class="panel panel-default anim">
                        <div class="panel-heading">
                            <h3>Sign Up</h3>
                        </div>

                        <div class="panel-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" maxlength="128" id="email">
                                </div>

                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" name="username" maxlength="64" id="username">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" maxlength="32" id="password">
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirm password:</label>
                                    <input type="password" class="form-control" name="confirm_password" maxlength="32" id="confirm_password">
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="">Remember me</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign Up">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</html>
