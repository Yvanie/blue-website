<?php use BleuWebsite\Core\Menu; ?>
<!-- Sidebar -->
<ul class=" navbar-nav bg-gradient-primary sidebar sidebar-dark accordion position-sticky  " id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class=" sidebar-brand d-flex align-items-center justify-content-center" href="index.php?p=home">
    <div class="sidebar-brand-icon ">

        <img src="Public/img/logo-footer.png" style="size: 30px; height:30px" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">BLue Ocean </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<?= Menu::list('index.php?p=dashboard', 'tachometer-alt', 'Dashboard') ?>
<?= Menu::list('index.php?p=blogs', 'blog', 'Blogs') ?>
<?= Menu::list('index.php?p=contact', 'phone', 'Contact') ?>
<?= Menu::list('index.php?p=users', 'users', 'Users') ?>
<?= Menu::list('index.php?p=mail', 'at', 'Mail') ?>
<?= Menu::list('index.php?p=profile', 'user', 'Profile') ?>




<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>

<!-- End of Sidebar -->