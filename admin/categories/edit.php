<?php 
require_once '../../functions/connection.php';
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';


if(!isset($_GET['categoryID'])){
    redirect('admin/categories');
}
global $pdo;

$query = "SELECT * FROM `categories` WHERE id=? ;";
$statement = $pdo->prepare($query);

$statement->execute([
    $_GET['categoryID']
]);

$category= $statement->fetch();

if($category === false)
{
    redirect('admin/categories');
}

if(isset($_POST['name']) && $_POST['name']!== ''){
  global $pdo;
  $query= "UPDATE `categories` SET name = ?, updated_at = now() WHERE id= ?";
  $statement= $pdo->prepare($query);
  $statement->execute([
    $_POST['name'],
    $_GET['categoryID']
  ]);

  redirect('admin/categories');
}




?>
<!DOCTYPE html>
<html lang="en">

<?php require_once '../layout/head.php';?>

<body>

<?php require_once '../layout/header.php';?>

<?php require_once '../layout/sidebar.php';?>

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

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="<?=url('admin/categories/edit.php?categoryID='.$category->id)?>" method="POST">
                <div class="col-12">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?=$category->name?>">
                </div>
                <div class="col-12">
                  <label for="parent" class="form-label">Parent</label>
                  <select id="parent" class="form-select" name="parent">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>

</main><!-- End #main -->

 <?php require_once '../layout/footer.php';?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <?php require_once '../layout/script.php';?>
</body>

</html>