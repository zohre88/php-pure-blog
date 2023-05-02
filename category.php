<?php 
session_start();
require_once 'functions/helpers.php';
require_once 'functions/connection.php';
global $pdo;
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'layout/head.php'?>

<body>

<?php require_once 'layout/header.php'?>

  <main id="main">

    <!-- ======= Lifestyle Category Section ======= -->
    <section class="category-section">
      <div class="container" data-aos="fade-up">
      <?php 
        $query = "SELECT * FROM `categories` WHERE id=? ;";
        $statement = $pdo->prepare($query);

        $statement->execute([
            $_GET['categoryID']
        ]);

        $category= $statement->fetch();

        if($category !== false){?>
        <div class="section-header d-flex justify-content-between align-items-center mb-5">

           <h2><?= $category->name?></h2>
        </div>

        <div class="row g-5">
        <?php
            $query="SELECT posts.*, categories.name as category_name FROM `posts` LEFT JOIN `categories` ON posts.category_id=categories.id WHERE posts.status=1 AND posts.category_id=?;";
            $statement= $pdo->prepare($query);
            $statement->execute([$_GET['categoryID']]);
            $posts=$statement->fetchAll();
            $count=1;
            foreach($posts as $post){?>
          <div class="col-lg-4">
            <div class="post-entry-1 lg">
              <a href="single-post.html"><img src="<?= asset($post->image)?>" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date"><?=$post->category_name?></span> <span class="mx-1">&bullet;</span> <span><?= $post->created_at?></span></div>
              <h2><a href="single-post.html"><?=$post->title?></a></h2>
              <p class="mb-4 d-block"><?=$post->body?></p>
              <div ><a href="<?= url('post.php?post_id='.$post->id)?>"><button type="submit">Read More ...</button></a></div>
            </div>
          </div>
          <?php }?>
        
        </div> <!-- End .row -->
        <?php }else{?>
Categoty Not Found
        <?php }?>
      </div>
    </section><!-- End Lifestyle Category Section -->

  </main><!-- End #main -->

<?php require_once 'layout/footer.php'?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <?php  require_once 'layout/script.php'?>

</body>

</html>