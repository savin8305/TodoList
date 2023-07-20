<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
        <header class="bg-dark">
            <nav class="container-fluid container-md px-3 px-5-lg navbar navbar-expand-lg navbar-dark">
            <?php
                if (isset($_SESSION['logged'])):
                // Show Navbar If The User Is Authenticated
            ?>
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php?action=afficher">TODO</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?action=afficher">Todos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Settings</a>
                            </li>
                        </ul>
                    <a href="index.php?action=logout" class="btn btn-danger">Sign Out</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-end w-100">
                    <a href="index.php?action=login" class="btn btn-primary">Login</a>
                    <a href="index.php?action=sign_up" class="btn btn-warning">Sign Up</a>
                </div>
            <?php endif; ?>
        </nav>
        </header>
    
    <main class="container-fluid container-md p-3 p-5-lg">

        <noscript>
            <div class="alert alert-warning">Javascript Must Be Activated</div>
        </noscript>

        <!-- Page Title -->
        <?= isset($title)?"<h1 class='border-bottom pb-2 mb-4'>$title</h1>": ""?>

        <?= $content?>


    </main>
</body>
</html>