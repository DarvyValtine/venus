<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>A propos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h5>A propos</h5>
   <p> <a href="home.php">accueil</a> / A propos </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/img3.png" alt="">
      </div>

      <div class="content">
         <h5>pourquoi nous ?</h5>
         <p>Chez Deen's Jewerly, nous croyons en la qualité, l'innovation et le service client exceptionnel. Fondé dans l'objectif de prioriser la satisfaction client, et de fournir des produits de haute qualité à des prix abordables. Notre équipe est composée de passionnés qui partagent une vision commune : rendre les accesoires accessibles. </p>
         <p>Nous sommes fiers de notre engagement envers la satisfaction du client et travaillons sans relâche pour dépasser vos attentes.</p>
         <a href="contact.php" class="btn">contact</a>
      </div>

   </div>

</section>
<div class="accordion-container">
        <div class="banner"></div>
        <h1>Deen's Jewerly</h1>
        <div class="content">
            <ul class="accordion">
                <li>
                    <input type="checkbox" id="item1" checked>
                    <label for="item1">
                        <i></i>
                        <h2>Découvrez une vaste gamme d'accessoires</h2>
                    </label>
                    <p>Découvrez une vaste gamme d'accessoires pour tous les goûts et toutes les occasions.</p>
                </li>
                <li>
                    <input type="checkbox" id="item2" checked>
                    <label for="item2">
                        <i></i>
                        <h2>Prix Compétitifs</h2>
                    </label>
                    <p>Profitez de produits de haute qualité à des prix abordables.</p>
                </li>
                <li>
                    <input type="checkbox" id="item3" checked>
                    <label for="item3">
                        <i></i>
                        <h2>Engagement Écoresponsable</h2>
                    </label>
                    <p>Nous nous efforçons de minimiser notre impact environnemental en adoptant des pratiques durables.</p>
                </li>
            </ul>
            <div class="accordion-image">
                <img src="images/img1.png" alt="Accordion Image">
            </div>
        </div>
    </div>

<!--<section class="authors">

   <h5 class="title">greate authors</h5>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h5>john deo</h5>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h5>john deo</h5>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h5>john deo</h5>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h5>john deo</h5>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h5>john deo</h5>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h5>john deo</h5>
      </div>

   </div>

</section>-->






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>