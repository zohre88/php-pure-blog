<?php 
require_once '../../functions/connection.php';
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once '../layout/head.php';?>

<body>

<?php require_once '../layout/header.php';?>

<?php require_once '../layout/sidebar.php';?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Categories</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Categories</li>
    </ol>
  </nav>
  <a href="<?= url('admin/categories/create.php')?>" style="text-align: right;">
  <button type="button" class="btn btn-success">Create</button>
  </a>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <p></p>

          <!-- Table with stripped rows -->
          <table class="table datatable datatable-table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Setting</th>
              </tr>
            </thead>
            <tbody>
                <?php
                global $pdo; 
                $query="SELECT * FROM `categories` ";
                $statement= $pdo->prepare($query);
                $statement->execute();
                $categories=$statement->fetchAll();
                $count=1;
                foreach($categories as $category){?>
                    <tr>
                        <th scope="row"><?=$count?></th>
                        <td><?= $category->name?></td>
                        <td>
                            <a href="<?= url('admin/categories/edit.php?categoryID='.$category->id)?>">
                            <span class="badge bg-primary"><i class="bx bxs-edit"></i></span>
                            </a>
                            <a href="<?= url('admin/categories/delete.php?categoryID='.$category->id)?>">
                            <span class="badge bg-danger"><i class="bx bxs-trash"></i></span>
                            </a>
                        </td>
                    </tr>
                <?php
                $count++;
                }
                ?> 
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

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