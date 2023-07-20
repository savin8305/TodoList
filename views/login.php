<?php
    $title = "Sign In";

    ob_start();
?>
    <form action="index.php?action=authentification" method="post" class="pb-4">

        <div class="alert alert-info">
            You can use the following infos for login testing: <br>
            <strong>Login:</strong> 'alaoui.rachid' and <strong>Password:</strong> '123456'
        </div>

        <div class="alert alert-danger d-none" id="danger-alert"></div>

        <div>
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" name="username">
        </div>

        <div class="my-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" name="password">
        </div>

        <input type="submit" value="Sign In" class="btn btn-primary btn-lg">

    </form>

    <script src="scripts/main.js"></script>

<?php
    $content = ob_get_contents();
    ob_get_clean();

    require "views/master.php";
?>