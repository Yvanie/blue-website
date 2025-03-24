 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blue Ocean Group | <?= ucfirst($_GET['p'])  ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
          <!-- Custom styles for this template-->
    <link href="Public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
        <?php 
    if(isset($mycss)){
        foreach($mycss as $css){
            echo '<link href="'.$css.'.css" rel="stylesheet">';
        }
    } ?>

    <!-- Custom styles for this template-->
    <link href="Public/css/sb-admin-2.min.css" rel="stylesheet">

    
</head>

<body <?= ($_GET['p'] == 'login') ? 'class="bg-gradient-transparent"' : 'id="page-top"'; ?>>
    <?php
    if ($_GET['p'] !== 'login') {
    ?>
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include 'Views/Parts/side.php'; ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content ">

                    <!-- Topbar -->
                    <?php include 'Views/Parts/top.php'; ?>
                    <!-- End of Topbar -->
                <?php



            } ?>

                <?= $content ?>

                <?php if ($_GET['p'] != 'login') : ?>
                    <!-- Footer -->
                    <?php include 'Views/Parts/footer.php'; ?>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->
        <?php endif; ?>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

       
        <!-- jQuery (required for DataTables) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
       
        <!-- Bootstrap 4 JS (required for modals) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS from CDN -->
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>              

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="Public/js/sb-admin-2.min.js"></script>
        <script src="Public/js/common.js"></script>

       <?php 
       if(isset($myjs)){
        foreach($myjs as $js){
            echo '<script src="'.$js.'.js"></script>'; 
        
        }}
       ?>



</body>

</html>