<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'le statut du paiement a été mis à jour!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

$search_query = "";
if (isset($_GET['search'])) {
   $search_query = mysqli_real_escape_string($conn, $_GET['search']);
   $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE name LIKE '%$search_query%' OR number LIKE '%$search_query%'") or die('query failed');
} else {
   $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<div class="admin-orders">
<section class="orders">
   <h3 class="title">commandes passées</h3>

   <form action="admin_orders.php" method="GET" class="search-form">
      <input type="text" name="search" placeholder="Rechercher par nom ou numéro" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
      <button type="submit" class="icon-btn">Rechercher</button>
   </form>

   <div class="box-container">
      <?php
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> identifiants : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> placé sur : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> nom : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> numero : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> addresse : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> total produits : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> montant total : <span><?php echo $fetch_orders['total_price']; ?>FCFA</span> </p>
         <p>methode de paiement : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <!--<option value="pending" selected disabled> /option>-->
               <option value="en attente" ><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="en preparation">en cours</option>
               <option value="effectuee">effectuee</option>
            </select><div class="action-icons">
            <input type="submit" value="actualiser" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('supprimer cette commande?');" class="delete-btn">supprimer</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">aucune commande effectuee!</p>';
      }
      ?>
   </div>

</section>
   </div>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>