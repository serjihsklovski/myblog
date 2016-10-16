<form method="post" action="/user/sign-up">
    <?php

    if (isset($errors)) {
        echo '<b style="color: darkred">In the registration form the following errors have been found:</b><br>';
        echo '<ul>';

        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }

        echo'</ul>';
    }

    ?>
    <!-- Username - required field -->
    <div class="form-group">
        <label for="username">Username *:</label>
        <input type="text" class="form-control" name="username" maxlength="64" id="username" required="required">
    </div>

    <!-- Password - required field -->
    <div class="form-group">
        <label for="password">Password *:</label>
        <input type="password" class="form-control" name="password" maxlength="32" id="password" required="required">
    </div>

    <!-- Confirm password - required field -->
    <div class="form-group">
        <label for="confirm_password">Confirm password *:</label>
        <input type="password" class="form-control" name="confirm_password" maxlength="32" id="confirm_password" required="required">
    </div>

    <!-- Answer - required field -->
    <div class="form-group">
        <label for="answer">Answer the question *:</label> <i>Type a year when the first computer worm has been created</i>
        <input type="text" class="form-control" name="answer" maxlength="32" required="required">
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" maxlength="128" id="email">
    </div>

    <!-- Remember me - checkbox -->
    <div class="form-group">
        <div class="checkbox">
            <label><input type="checkbox" value="true" name="remember_me">Remember me</label>
        </div>
    </div>

    <!-- Submit button -->
    <div class="form-group">
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign Up">
    </div>
</form>
