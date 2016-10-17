<form method="post" action="/user/login">
    <?php

    if (isset($errors)) {
        echo '<b style="color: darkred">In the registration form the following errors have been found:</b><br>';
        echo '<ul>';

        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }

        echo '</ul>';
    }

    ?>

    <!-- Username -->
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" maxlength="64" id="username" required="required">
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" maxlength="32" id="password" required="required">
    </div>

    <!-- Remember me - checkbox -->
    <div class="form-group">
        <div class="checkbox">
            <label><input type="checkbox" value="true" name="remember_me">Remember me</label>
        </div>
    </div>

    <!-- Submit button -->
    <div class="form-group">
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
    </div>
</form>
