<?php
    // $title = "";

    ob_start();
?>

  <div class="d-flex align-items-center justify-content-center vh-75">
    <div class="text-center">
      <h1 class="display-1 fw-bold">401</h1>
      <p class="fs-3"><span class="text-danger">Opps!</span> Unauthorized.</p>
      <p class="lead">Login required to access such resource.</p>
      <a href="index.php" class="btn btn-primary">Sign In</a>
    </div>
  </div>

<?php
  $content = ob_get_contents();
  ob_get_clean();

  require "views/master.php";
?>