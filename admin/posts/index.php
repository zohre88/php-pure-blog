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
  <h1>All Posts</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Posts</li>
    </ol>
  </nav>
  <a href="<?= url('admin/posts/create.php')?>" style="text-align: right;">
  <button type="button" class="btn btn-success">Create</button>
  </a>
</div><!-- End Page Title -->

<section class="section show-table">
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
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <!-- <th scope="col">Body</th> -->
                <th scope="col">Category Name</th>
                <th scope="col">Status</th>
                <th scope="col">Setting</th>
              </tr>
            </thead>
            <tbody>
                <?php
                global $pdo; 
                $query="SELECT posts.*, categories.name as category_name FROM `posts` LEFT JOIN `categories` ON posts.category_id=categories.id";
                $statement= $pdo->prepare($query);
                $statement->execute();
                $posts=$statement->fetchAll();
                $count=1;
                foreach($posts as $post){?>
                    <tr>
                        <th scope="row"><?=$count?></th>
                        <td>
                           <a href="#"><img src="<?= asset($post->image)?>" alt=""></a>
                        </td>
                        <td><?= $post->title?></td>
                        <!-- <td><?= substr($post->body, 0, 30).' ...'?></td> -->
                        <td><?= $post->category_name?></td>
                        <td>
                            <?php 
                            if($post->status == 1){
                               echo '<span class="text-success small pt-1 fw-bold">enable</span>'; 
                            }else{
                                echo '<span class="text-danger small pt-1 fw-bold">disable</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?= url('admin/posts/change-status.php?postID='.$post->id)?>">
                            <span class="badge bg-warning">change status</span>
                            </a>
                            <a href="<?= url('admin/posts/edit.php?postID='.$post->id)?>">
                                <span class="badge bg-primary"><i class="bx bxs-edit"></i></span>
                            </a>
                            <a href="<?= url('admin/posts/delete.php?postID='.$post->id)?>">
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