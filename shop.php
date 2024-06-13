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
      $message[] = 'produit deja ajoute!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'produit ajoute!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>boutique</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading-shop">
   <h5>notre boutique</h5>
   <p> <a href="home.php">accueil</a> / boutique </p>
</div>

<section class="products">
      
   <h5 class="title">produits recents</h5>

   <form method="get" class="sort-form">
   <label for="sort">Trier par: </label>
   <select name="sort" id="sort" onchange="this.form.submit()">
      <option value="default" <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'default') echo 'selected'; ?>>Par défaut</option>
      <option value="low_to_high" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'low_to_high') echo 'selected'; ?>>Prix: du plus bas au plus élevé</option>
      <option value="high_to_low" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'high_to_low') echo 'selected'; ?>>Prix: du plus élevé au plus bas</option>
      <option value="newest" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'newest') echo 'selected'; ?>>Nouveautés</option>
      <option value="popularity" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'popularity') echo 'selected'; ?>>Popularité</option>
      <option value="name" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name') echo 'selected'; ?>>Nom</option>
      <option value="discount" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'discount') echo 'selected'; ?>>Réduction</option>
   </select>
</form>


   <div class="box-container">
      <?php  
         $sort_order = "ORDER BY id DESC"; // Default sort order
         if (isset($_GET['sort'])) {
             switch ($_GET['sort']) {
                 case 'low_to_high':
                     $sort_order = "ORDER BY price ASC";
                     break;
                 case 'high_to_low':
                     $sort_order = "ORDER BY price DESC";
                     break;
                 case 'newest':
                     $sort_order = "ORDER BY created_at DESC";
                     break;
                 case 'popularity':
                     $sort_order = "ORDER BY popularity DESC";
                     break;
                 case 'name':
                     $sort_order = "ORDER BY name ASC";
                     break;
                 case 'discount':
                     $sort_order = "ORDER BY discount DESC";
                     break;
             }
         }
         
         $select_products = mysqli_query($conn, "SELECT * FROM `products` $sort_order") or die('query failed');
         
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
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
      } else {
         echo '<p class="empty">aucun produit ajouté!</p>';
      }
      ?>
   </div>
   <br>
   <p>Livraison standard entre 24 et 72h </p>
</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>