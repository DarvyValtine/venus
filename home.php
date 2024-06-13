<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>accueil</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h5>Obtenez l'article que vous desirez.</h5>
      <p>Bienvenue chez Deen's Jewerly, votre boutique en ligne pour des bijoux d'exception. Découvrez notre collection de bagues, colliers, bracelets et boucles d'oreilles, conçus pour ajouter une touche d'élégance à chaque moment. 
      </p>
      <a href="about.php" class="white-btn">plus</a>
   </div>

</section>

<section class="products">

   <h3 class="title">Produits recents</h3>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price"><?php echo $fetch_products['price']; ?>FCFA</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <button type="submit" name="add_to_cart" class="btn"><i class="fas fa-shopping-cart"></i></button>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">encore aucun produit ajoute!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">plus</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/img.png" alt="">
      </div>

      <div class="content">
         <h5>Au sujet de Deen's Jewerly </h5>
         <p>Deen's Jewerly a été animé par une passion pour les bijoux. Notre mission est de créer des pièces qui allient beauté, qualité et exclusivité. Nous collaborons avec des artisans talentueux qui partagent notre vision d'une bijouterie raffinée et durable. Notre équipe s'engage à vous offrir un service exceptionnel, des conseils personnalisés, et une expérience de shopping inégalée.
</p>
         <a href="about.php" class="btn">plus</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h5>plus de questions?</h5>
      <p>Nous aimons entendre nos clients. Pour toute question, commentaire ou demande spéciale, vous pouvez nous contacter par e-mail, par téléphone, ou via notre formulaire de contact ci-dessous. Notre équipe est là pour vous aider à trouver le bijou parfait ou pour répondre à toute question que vous pourriez avoir.
</p>
      <a href="contact.php" class="white-btn">nous contater</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>