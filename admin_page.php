<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h3 class="title">Tableau de bord</h3>

   <div class="main-container">
      <div class="box-container">

         <div class="box">
            <?php
               $total_pendings = 0;
               $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
               if(mysqli_num_rows($select_pending) > 0){
                  while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                     $total_price = $fetch_pendings['total_price'];
                     $total_pendings += $total_price;
                  };
               };
            ?>
            <h3>FCFA<?php echo $total_pendings; ?>/-</h3>
            <p>Total en cours</p>
          
            <?php
               $total_completed = 0;
               $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
               if(mysqli_num_rows($select_completed) > 0){
                  while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                     $total_price = $fetch_completed['total_price'];
                     $total_completed += $total_price;
                  };
               };
            ?>
            <h3>FCFA<?php echo $total_completed; ?>/-</h3>
            <p>Paiements complets</p>
          
            <?php 
               $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
               $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?></h3>
            <p>Commandes passées</p>
          
            <?php 
               $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
               $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products; ?></h3>
            <p>Produits ajoutés</p>
          
            <?php 
               $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
               $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?></h3>
            <p>Utilisateurs normaux</p>
          
            <?php 
               $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
               $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins; ?></h3>
            <p>Utilisateurs admin</p>
          
            <?php 
               $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
               $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><?php echo $number_of_account; ?></h3>
            <p>Total des comptes</p>
          
            <?php 
               $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
               $number_of_messages = mysqli_num_rows($select_messages);
            ?>
            <h3><?php echo $number_of_messages; ?></h3>
            <p>Nouveaux messages</p>
         </div>

      </div>

      <div class="sales-container">
         <h3>Statistiques des ventes</h3>
         <canvas id="salesChart"></canvas>
      </div>
   </div>

</section>

<!-- admin dashboard section ends -->

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Example of a sales chart using Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Sales',
                data: [12, 19, 3, 5, 2, 3, 7],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<!-- admin dashboard section ends -->









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>