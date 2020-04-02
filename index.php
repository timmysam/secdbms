<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--<meta property="og:title" content="" />-->
    <!--<meta property="og:url" content="" />-->
    <!--<meta property="og:image" content="" />-->
    <!--<meta property="og:site_name" content="" />-->
    <!--<meta property="og:description" content="" />-->
    <title>Course Project</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/index.css">
    <!--[if lt IE 9]>
            <script src="scripts/html5shiv.min.js"></script>
        <![endif]-->
</head>

<body>
  <section class="cover-main" id="home">
          <header>
                <nav class="nav-wrapper">
                    <div class="logo">
                        <a href="#">
                          <img src="images/white-logo.png" class="logo">
                        </a>
                    </div>
                    <ul class="menu">
                        
                        <li><a href="#">My Work</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="events/pay_fess.php">Pay your School fess</a></li>
                        <li><a href="login.php">login</a></li>
                        <li><a href="">Contact Us</a></li>
                        <li><a href="log_out.php">Sign Out</a></li>

                    </ul>
              </nav>
         </header>

            <div class="wrapper">
             <ul id="scene"
                   data-invert-x="false"
                   data-invert-y="false"
                   data-scalar-x="7"
                   data-scalar-y="7"
                   data-friction-x="0.1"
                   data-friction-y="0.1"  
                   data-origin-x="0.5"
                   data-origin-y="0.5">
                 <li class="layer name" data-depth="0.90">Your Name Here</li>
                 <li class="layer title" data-depth="0.50">Your Designation Here</li>
                 <li class="layer btn btn-main" data-depth="0.30">
                   <a href="#" class="portfolio-btn">View Portfolio</a>
                   <a href="#" class="contact-btn">Contact Me</a>
                 </li>
             </ul>
           </div>
</section>

<section class="masonry-grid" id="work">
    <h2 class="sub-title">My Photography Portfolio</h2>
    <div class="grid">
      <div class="grid-item"><img src="images/church.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church2.jpg" alt=""></div>
      <div class="grid-item tall-img"><img src="images/church3.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church4.jpg" alt=""></div>
      <div class="grid-item tall-img"><img src="images/church5.png" alt=""></div>
      <div class="grid-item"><img src="images/church6.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church7.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church8.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church9.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church11.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church13.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church14.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church15.jpg" alt=""></div>
      <div class="grid-item"><img src="images/church12.jpg" alt=""></div>
    </div>
</section>

<div id="footer">
  <h2 class="designer"> @samizpah enterprise</h2>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="scripts/parallax.min.js"></script>
        <script src ="scripts/masonry.js"></script>
        <script src="scripts/mainPage.js"></script>

        <script>

            var scene = document.getElementById('scene');
            var parallax = new Parallax(scene);

        </script>
       

</body>
</html>