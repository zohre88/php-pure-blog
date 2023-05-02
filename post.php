<?php 
session_start();
require_once 'functions/helpers.php';
require_once 'functions/connection.php';
global $pdo;
if(!isset($_GET['post_id'])){
    redirect('index.php');
}
  
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'layout/head.php'?>

<body>

<?php require_once 'layout/header.php'?>

  <main id="main">
    <section class="single-post-content">
        <div class="container">
            <div class="row">
            <div class="col-md-9 post-content" data-aos="fade-up">
                <?php 
                //check for exists post id
                $query = "SELECT posts.*, categories.name as category_name FROM `posts` LEFT JOIN `categories` ON posts.category_id=categories.id WHERE posts.status= 1 AND posts.id=?;";
                $statement = $pdo->prepare($query);
                $statement->execute([
                $_GET['post_id']
                ]);
                $post= $statement->fetch();
                if($post !== false){?>
                <!-- ======= Single Post Content ======= -->
                <div class="single-post">
                    <div class="post-meta"><span class="date"><?=$post->category_name?></span> <span class="mx-1">&bullet;</span> <span><?=$post->created_at?></span></div>
                    <h1 class="mb-5"><?=$post->title?></h1>
                    <figure class="my-4">
                        <img src="<?= asset($post->image)?>" alt="" class="img-fluid">
                    </figure>
                    <p><?= $post->body?></p>
                </div><!-- End Single Post Content -->
                <?php }else{?>
                    Not found
                <?php }?>
               


            </div>
            <div class="col-md-3">
                <!-- ======= Sidebar ======= -->
                <div class="aside-block">

                    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
                    </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                            <?php
                            $query="SELECT posts.*, categories.name as category_name FROM `posts` LEFT JOIN `categories` ON posts.category_id=categories.id WHERE posts.status=1;";
                            $statement= $pdo->prepare($query);
                            $statement->execute();
                            $posts=$statement->fetchAll();
                            $count=1;
                            foreach($posts as $post){?>          
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta">
                                        <span class="date"><?=$post->category_name?></span> 
                                        <span class="mx-1">&bullet;</span> 
                                        <span><?=$post->created_at?></span>
                                    </div>
                                    <h2 class="mb-2">
                                        <a href="#"><?=$post->title?></a>
                                    </h2>
                                    <div class="author mb-3 d-block">
                                        <?=substr($post->body,0, 80 )?>
                                    </div>
                                </div>
                            <?php }?>

                        </div> <!-- End Popular -->

                    </div>
                </div>


            </div>
            </div>
        </div>
        </section>
  </main><!-- End #main -->

<?php require_once 'layout/footer.php'?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <?php  require_once 'layout/script.php'?>

</body>

</html>
