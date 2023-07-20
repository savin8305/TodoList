<?php
    $title = "Sign Up";

    ob_start();
?>
    <form action="index.php?action=register" method="post" class="pb-4">

        <div class="alert alert-danger d-none" id="danger-alert"></div>

        <div>
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" name="username">
        </div>

        <div class="my-3">
            <label for="email" class="form-label">email</label>
            <input type="email" id="email" class="form-control" name="email">
        </div>

        <div class="my-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" name="password">
        </div>

        <div class="my-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" id="confirm_password" class="form-control" name="confirm_password">
        </div>

        <input type="submit" value="Sign Up" class="btn btn-primary btn-lg">

    </form>

    <script src="scripts/sign_up.js" defer></script>

<?php
    $content = ob_get_contents();
    ob_get_clean();

    require "views/master.php";
?>