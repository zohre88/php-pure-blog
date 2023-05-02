<?php 
require_once '../functions/helpers.php';
require_once '../functions/check-login.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'layout/head.php';?>

<body>

<?php require_once 'layout/header.php';?>

<?php require_once 'layout/sidebar.php';?>

<main id="main" class="main">

<div class="pagetitle">
    <h1>Blank Page</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Pages</li>
        <li class="breadcrumb-item active">Blank</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    <div class="col-lg-6">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Example Card</h5>
            <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
        </div>
        </div>

    </div>

    <div class="col-lg-6">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Example Card</h5>
            <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
        </div>
        </div>

    </div>
    </div>
</section>

</main><!-- End #main -->

 <?php require_once 'layout/footer.php';?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <?php require_once 'layout/script.php';?>
</body>

</html>