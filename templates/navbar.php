<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><?php echo Application::$config['app']['name'] ?></a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="/">Main</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="/user/sign-up"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="/user/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>
