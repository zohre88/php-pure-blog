 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url('admin/dashboard.php')?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->


  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?=url('admin/categories/index.php')?>">
      <i class="bi bi-menu-button-wide"></i>
      <span>Categories</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url('admin/posts')?>">
      <i class="bi bi-card-list"></i>
      <span>Posts</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url('auth/logout.php')?>">
      <i class="bi bi-box-arrow-in-left"></i>
      <span>Logout</span>
    </a>
  </li><!-- End Login Page Nav -->


</ul>

</aside><!-- End Sidebar-->