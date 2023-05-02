<?php 
require_once '../functions/helpers.php';
require_once '../functions/connection.php';
$error='';
// dd($_POST);
if(
    isset($_POST['first_name']) && $_POST['first_name']!=='' && 
    isset($_POST['last_name']) && $_POST['last_name']!=='' && 
    isset($_POST['email']) && $_POST['email']!=='' && 
    isset($_POST['password']) && $_POST['password']!=='' && 
    isset($_POST['c_password']) && $_POST['c_password']!==''
    )
    {
        global $pdo;
        if($_POST['password']=== $_POST['c_password']){
            if(strlen($_POST['password'])>5){
                $query = "SELECT * FROM `users` WHERE email=?;";
                $statement = $pdo->prepare($query);
                $statement->execute([
                    $_POST['email']
                ]);
                $user= $statement->fetch();
                if($user === false){
                    $query = "INSERT INTO `users` SET first_name=?, last_name = ?, email = ?, password = ?, created_at = now();";
                    $statement = $pdo->prepare($query);
                    $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement->execute([
                        $_POST['first_name'], $_POST['last_name'], $_POST['email'], $password
                    ]);
                    redirect('admin/dashboard.php');
                }else{
                    $error = 'email exists';
                }
            }else{
                $error = 'password feild is more than 5';
            }
        }else{
            $error = 'confirm password is not equal with password ';
        }
        
    }else{
      $error = 'all feild is required';
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small"><?php if($error !== '') echo $error;?></p>
                  </div>

                  <form class="row g-3 needs-validation" action="<?= url('auth/register.php')?>" method="POST">
                    <div class="col-12">
                      <label for="first_name" class="form-label">first Name</label>
                      <input type="text" name="first_name" class="form-control" id="first_name" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>
                    <div class="col-12">
                      <label for="last_name" class="form-label">last Name</label>
                      <input type="text" name="last_name" class="form-control" id="last_name" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <label for="c_password" class="form-label">Confirm Password</label>
                      <input type="password" name="c_password" class="form-control" id="c_password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.html">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by  Venus</a>
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