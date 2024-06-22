<?php
session_start();
include 'connection.php';
?>
</html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/icon.css">
        <link rel="stylesheet" href="css\home-page1.css">
        <title>home page</title>
        <style>
            .account{
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid black;
                width: 200px;
                border-radius: 50px;
                height: 40px;
                z-index: 1000;
                cursor: pointer;
            }
            .acount:hover{
                border: 1px solid #7407FE;
  
            }
            .account img{
                max-width: 18%;
                margin: 10px;
                border-radius: 100%;
                border: 1px solid black;
            }
            .account h1{
              font-size: 22px;
            }
        </style>

</head>
<body>
<div class="homepage">
    <div class="navbar">
        <div class="logo">
          <img src="images\logo.png">
          <p>LABOURease</p></div>
          <div class="link">
          <h3><a class="navlink" href="#hero" >How it works?</a></h3>
          <h3><a class="navlink" href="#problemsol">why us?</a></h3>
          <h3><a class="navlink" href="#join">find work</a></h3>
          <h3><a class="navlink" href="#faqs">FAQs</a></h3>
          </div>
          <?php
          if(isset($_SESSION['name'])){
            echo"<a style='text-decoration:none;'  href='User_page.php'>
            <div class='account'>
            <h1>Account</h1>
            <img src='images/user.png'>
            </div></a>";
            }elseif(isset($_SESSION['Wname'])){
              echo"<a style='text-decoration:none;'  href='worker-page.php'>
              <div class='account'>
              <h1>Account</h1>
              <img src='images/user.png'>
              </div></a>";
            }else{
                echo"
                <div class='button'>
                <a style='color:#000' href='beforelog.html'><button class='login' >LOGIN</button></a>
                <a href='get-started.html'><button style='color:#fff' class='singup'>SINGUP</button></a>
                </div>";
            
            }
        
          ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
      let lllist=document.querySelector(".profile-dorpdown-list");
      function toggleMenu(){
        lllist.classList.toggle("show");
      }


      $(document).ready(function() {
        $(window).scroll(function(){
            if($(window).scrollTop()){
                $(".navbar").addClass("sticky");
            }
            else{
                $(".navbar").removeClass("sticky");
            }
        });
    });
    
    </script>
    
   <div id="hero" class="hero">
    <div class="content">
    <h1>Meet Quality Craftsmanship, Effortlessly</h1>
    <p>Tap into a network of skilled construction workers ready for your project.Effortless and swift, just a click away.  </p>
    <a href="Ccreate.php"><button>SEARCH</button></a></div>
    <img src="images\hero.jpeg">
</div>

<div id="problemsol" class="problemsol">
  <img src="images/sol.jpg">
<div class="problem">
  <h3>challenges in find ingerliable workers swiftly</h3>
  <p> LABOURease provide an intuitive and rapid means to locate and connect with nearby workers, ensuring quick access to the labor force needed for your projects.</p>
</div>
<ul style="list-style:none;" class="sol">
<span class="material-symbols-outlined">check_circle</span><li class="card swift"><h3>swift connections</h3></li><br>
<span class="material-symbols-outlined">check_circle</span><li class="card direct"><h3>direct communication</h3> </li><br>
<span class="material-symbols-outlined">check_circle</span><li class="card empower"><h3>emprowing local label </h3></li>
</ul>
</div>

<div id="join" class="join">
  <img src="images/worker.jpeg">
  <div class="info">
  <h1> Join and Thrive with Us</h1>
  <p>Take control of your construction work and expand your opportunities by joining our platform</p>
  <a href="wcreate.php"><button>JOIN</button></a>
</div>
</div>

<div id="faqs" class="FAQs">
  <h1>FAQs</h1>
  <div class="container">
  <div class="QandA">
   <div class="Qes">
    <p>What types of construction workers can I find on your platform?</p>
    <span class="material-symbols-outlined">expand_more</span>
   </div>
   <div class="Ans">
     <p>Our platform caters to a wide range of construction laborers, including carpenters, plumbers, electricians, masons, painters, and more.</p>
   </div>
  </div>
  <div class="QandA">
    <div class="Qes">
     <p>Are the workers on your platform vetted or verified?</p>
     <span class="material-symbols-outlined">expand_more</span>
    </div>
    <div class="Ans">
      <p>Our platform caters to a wide range of construction laborers, including carpenters, plumbers, electricians, masons, painters, and more.</p>
    </div>
   </div>
   <div class="QandA">
    <div class="Qes">
     <p>Is there a fee for using LABOURease?</p>
     <span class="material-symbols-outlined">expand_more</span>
    </div>
    <div class="Ans">
      <p>Our platform caters to a wide range of construction laborers, including carpenters, plumbers, electricians, masons, painters, and more.</p>
    </div>
   </div>
   <div class="QandA">
    <div class="Qes">
     <p>Are there any guarantees on the quality of work provided by the workers?</p>
     <span class="material-symbols-outlined">expand_more</span>
    </div>
    <div class="Ans">
      <p>Our platform caters to a wide range of construction laborers, including carpenters, plumbers, electricians, masons, painters, and more.</p>
    </div>
   </div>   
</div>
</div>
<script>
  const accordions = document.querySelectorAll('.QandA');

  accordions.forEach(accordion => {
      const icon = accordion.querySelector('.material-symbols-outlined');
      const Question= accordion.querySelector('.Qes');
      const answer = accordion.querySelector('.Ans');
  
      accordion.addEventListener('click', () => {
          if (icon.classList.contains('active')) {
              icon.classList.remove('active');
              Question.classList.remove('active')
              answer.style.maxHeight = null;
          } else {
              icon.classList.add('active');
              Question.classList.add('active');
              answer.style.maxHeight = answer.scrollHeight + 'px';
          }
      });
  });
  
</script>

<footer>
  <ul style="list-style: none;">
    <a href="AboutUS.html"><li>About US</li></a>
    <a href="contact.php"><li>Contact US</li></a>
    <a href="#"><li>Term and Searvices</li></a>
  </ul>
</footer>




</div>
</body>
</html>