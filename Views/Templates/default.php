<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Ocean Group | <?= ucfirst($_GET['p'])  ?></title>
     <!-- Bootstrap 4 CSS -->
  
    <link rel="stylesheet" href="Public/css/style.css">
    <?php 
    if(isset($mycss)){
        foreach($mycss as $css){
            echo '<link href="'.$css.'.css" rel="stylesheet">';
        }
    } ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="https://yvanie.github.io/blue-website/img/logo.jpg">
    <meta property="og:site_name" content="Blue Ocean Group" />
    <meta property=“og:title” content="consulting partner" />
    <meta property="og:description" content="emphasis on telecommunications and related fields." />
    <meta property="og:url" content="https://blue-oceangroup.com/"/>
    <meta property="og:type" content="Website" />
    <meta property="article:publisher" content="https://github.com/Yvanie"/>
    <meta property="og:image" content="https://yvanie.github.io/blue-website/img/logo.jpg" />
    <meta property="og:image:secure_url" content="https://yvanie.github.io/blue-website/" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="info-navbar">
    <div class="info-container">
        <div class="contact-info">
            <span class="email"><i class="fas fa-envelope"></i> contact@blue-oceangroup.com</span>
            <span class="phone"><i class="fas fa-phone-alt"></i> +237 233 434 605</span>
        </div>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</div>
<nav class="navbar" id="navbar">
    <div class="logo">
        <img src="Public/img/logo.jpg" alt="Logo" />
    </div>
    <div class="hamburger" id="hamburger">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="nav-links" id="nav-links">
        <li><a href="index.php?p=home" class="<?= (isset($_GET['p']) && $_GET['p']=='home') ? 'active': '' ?>">Home</a></li>
        <li><a href="index.php?p=about" class="<?= (isset($_GET['p']) && $_GET['p']=='about') ? 'active': '' ?>">About</a></li>
        <li><a href="index.php?p=service" class="<?= (isset($_GET['p']) && $_GET['p']=='service') ? 'active': '' ?>">Service</a></li>
        <li><a href="index.php?p=blogs" class="<?= (isset($_GET['p']) && $_GET['p']=='blogs') ? 'active': '' ?>">Blog</a></li>
        <li><a href="index.php?p=contact" class="<?= (isset($_GET['p']) && $_GET['p']=='contact') ? 'active': '' ?>">Contact</a></li>
    </ul>
</nav>
<button id="scrollToTopBtn" class="scroll-to-top-btn"><i class="fas fa-arrow-up"></i></button>

    <?= $content; ?>
    
    <footer class="footer">
    <div class="footer-container">
        <div class="footer-column footer-logo">
            <img src="Public/img/logo-footer.png" alt="Logo" />
            <p class="footer-description">Unlock your potential with our expertise in telecommunications.
                We help you improve efficiencies and deliver sustainable growth by supporting you in maintaining
                uncontested market space and making competition irrelevant.</p>
            <div class="footer-social-icons">
                <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <div class="footer-column">
            <h3>Contact Information</h3>
            <ul class="footer-info">
                <li><i class="fas fa-map-marker-alt"></i> Akwa Douala Cameroon </li>
                <li><i class="fas fa-phone-alt"></i> +237 233391691</li>
                <li><i class="fas fa-envelope"></i> contact@blue-oceangroup.com</li>
                <li><i class="fas fa-clock"></i> Mon-Fri: 8am - 5pm</li>
            </ul>
        </div>

        <div class="footer-column" id="Newsletter">
            <h3>Newsletter</h3>
            <p>Subscribe to our newsletter for the latest updates.</p>
            <div id="clientMsg"></div>
            <form class="newsletter-signup" method="POST" id="formAddNewsletters">
                <input type="email" name="email" placeholder="Enter your email" class="form-control" />
                <button type="submit" name="submitbtn" class="btn btn1"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
   
</footer>
<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <!-- Bootstrap 4 JS (required for modals) -->
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
     
<script src="Public/js/common.js"></script>
<script src="Public/js/owner/mail-front.js"></script> 
<script src="Public/js/script.js"></script>  
    <?php 
       if(isset($myjs)){
        foreach($myjs as $js){
            echo '<script src="'.$js.'.js"></script>'; 
        
        }}
       ?>
</body>
</html>
