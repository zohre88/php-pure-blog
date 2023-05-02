  
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>ZenBlog</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="<?= url('index.php')?>">Home</a></li>
          <li class="dropdown"><a href="category.html"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <?php
                $query = "SELECT * FROM `categories` ";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $categories = $statement->fetchAll();
                foreach ($categories as $category){?>
                  <li><a href="<?= url('category.php?categoryID='.$category->id)?>"><?=ucfirst($category->name)?></a></li>
              <?php  }
              ?>
            </ul>
          </li>

          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <?php 
        if(isset($_SESSION['is_login'])){
          $query= "SELECT * FROM `users` WHERE id=?;";
          $statement = $pdo->prepare($query);
          $statement->execute([$_SESSION['user_id']]);
          $user = $statement->fetch();
        ?>
        <a href="<?= url('auth/admin/dashboard.php')?>" class="mx-2"><?= $user->first_name?></a>
          <a href="<?= url('auth/logout.php')?>" class="mx-2">logout</a>
        <?php }else{?>
          <a href="<?= url('auth/register.php')?>" class="mx-2">register</a>
          <a href="<?= url('auth/login.php')?>" class="mx-2">login</a>
        <?php }?>
        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->