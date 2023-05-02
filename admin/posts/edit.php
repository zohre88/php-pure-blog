<?php 
require_once '../../functions/connection.php';
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';
$global=$pdo;

if(!isset($_GET['postID'])){
    redirect('admin/posts');
}

//check for exists post id
$query = "SELECT * FROM `posts` WHERE id=?;";
$statement = $pdo->prepare($query);
$statement->execute([
  $_GET['postID']
]);
$post= $statement->fetch();
if($post === false){
  redirect('admin/posts');
}

if(
    isset($_POST['title']) && $_POST['title']!=='' && 
    isset($_POST['category']) && $_POST['category']!=='' && 
    isset($_POST['body']) && $_POST['body']!=='' 
    )
    {
         // check for category is correct or not:
      $query="SELECT * FROM `categories` WHERE id=?;";
      $statement=$pdo->prepare($query);
      $statement->execute([$_POST['category']]);
      $category=$statement->fetch();
     if( isset($_FILES['image']) && $_FILES['image']['name']!=='')
     {
        // the extension of image is correct or not
        $allowedMimes=['jpg', 'jpeg', 'png', 'gif'];
        $imageMime=pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if(!in_array($imageMime, $allowedMimes)){
            redirect('admin/posts');
        }
        $basePath=dirname(dirname(__DIR__));
        if(file_exists($basePath.$post->image)){
            unlink($basePath.$post->image);
        }
        $image='/assets/uploads/posts/'. date("Y_m_d_H_i_s"). '.'.$imageMime;
        $image_upload=move_uploaded_file($_FILES['image']['tmp_name'], $basePath.$image);
     }else{
        $image=$post->image;
     }

     if($category !== false){
        $query = "UPDATE `posts` SET title=?, category_id=?, body=?, image=?, updated_at=now() WHERE id=?;";
        $statement= $pdo->prepare($query);
        $statement->execute([
            $_POST['title'],$_POST['category'], $_POST['body'], $image, $_GET['postID'] 
        ]);
     }

redirect('admin/posts');


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
    <h1>Update Post</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Posts</a></li>
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
              <form class="row g-3" action="<?=url('admin/posts/edit.php?postID='.$post->id)?>" method="POST" enctype="multipart/form-data">
                <div class="col-12">
                  <label for="title" class="form-label">title</label>
                  <input type="text" class="form-control" id="title" name="title" value="<?= $post->title?>">
                </div>
                <div class="col-12">
                  <label for="category" class="form-label">Category</label>
                  <select id="category" class="form-select" name="category">
                    <?php
                    $query= "SELECT * FROM `categories`;";
                    $statement=$pdo->prepare($query);
                    $statement->execute();
                    $categories= $statement->fetchAll();
                    foreach($categories as $category){?>
                        <option value="<?= $category->id?>" <?php if($category->id == $post->category_id){ echo 'selected';}?>   ><?=$category->name?></option>  
                    <?php } 
                    ?>
                  </select>
                </div>
                <div class="col-12">   
                    <label for="inputNumber" class="form-label">File Upload</label>
                    <input class="form-control" type="file" id="image" name="image">
                    <p class="thumbnail-img pt-2"><img src="<?= asset($post->image)?>"></p> 
                </div>
                <div class="col-12">
                  <label for="inputNumber" class="form-label">Body</label>
                  <textarea class="form-control" rows="6" name="body"><?= $post->body?>"</textarea>
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