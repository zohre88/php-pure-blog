<?php 
session_start();
require_once '../functions/connection.php';
require_once '../functions/helpers.php';
$global=$pdo;
$error='';
if(isset($_SESSION['is_login'])){
    unset($_SESSION['is_login']);
    unset($_SESSION['user_id']);
}
if(isset($_POST['email']) && $_POST['email']!== ''&& 
isset($_POST['password']) && $_POST['password'])
{
    $query = "SELECT * FROM `users` WHERE email=?;";
    $statement = $pdo->prepare($query);
    $statement->execute([
        $_POST['email']
    ]);
    $user= $statement->fetch();
    if($user !== false){
        if(password_verify($_POST['password'], $user->password)){
            $_SESSION['is_login']= true;
            $_SESSION['user_id']=$user->id;
            redirect('admin/dashboard.php');
        }else{
            $error = 'password is not correct';
        }
    }else{
        $error= 'email is not correct';
    }

}else{
    if(!empty($_POST)){
        $error = 'all feild is required';
    }
   
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?= asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?= asset('assets/admin/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?= asset('assets/admin/vendor/quill/quill.snow.css')?>" rel="stylesheet">
  <link href="<?= asset('assets/admin/vendor/quill/quill.bubble.css')?>" rel="stylesheet">
  <link href="<?= asset('assets/admin/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?= asset('assets/admin/vendor/simple-datatables/style.css')?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= asset('assets/admin/css/style.css')?>" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small"><?php if($error!== '') echo $error?></p>
                  </div>

                  <form class="row g-3 needs-validation" action="<?= url('auth/login.php')?>" method="POST">

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label> 
                      <input type="text" name="email" class="form-control" id="email" >
                      <div class="invalid-feedback">Please enter your username.</div>
                      
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" >
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- Vendor JS Files -->
   <script src="<?=asset('assets/admin/vendor/apexcharts/apexcharts.min.js')?>"></script>
  <script src="<?=asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?=asset('assets/admin/vendor/quill/quill.min.js')?>"></script>
  <script src="<?=asset('assets/admin/vendor/simple-datatables/simple-datatables.js')?>"></script>
  <script src="<?=asset('assets/admin/vendor/tinymce/tinymce.min.js')?>"></script>
  <script src="<?=asset('assets/admin/vendor/php-email-form/validate.js')?>"></script>

  <!-- Template Main JS File -->
  <script src="<?=asset('assets/admin/js/main.js')?>"></script>

</body>

</html>