<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body class="messages">
   
<?php include 'admin_header.php'; ?>

<section class="messages">

    <h3 class="title">Messages</h3>

    <div class="box-container">
        <?php
        $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        if (mysqli_num_rows($select_message) > 0) {
            while ($fetch_message = mysqli_fetch_assoc($select_message)) {
        ?>
        <div class="box">
            <p> Identifiant : <span><?php echo $fetch_message['user_id']; ?></span> </p>
            <p> Nom : <span><?php echo $fetch_message['name']; ?></span> </p>
            <p> Numéro : <span><?php echo $fetch_message['number']; ?></span> </p>
            <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
            <p> Message : <span><?php echo $fetch_message['message']; ?></span> </p>
            <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('voulez-vous effacer ce message?');" class="delete-btn"><i class="fas fa-trash-alt"></i></a>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">Aucun message!</p>';
        }
        ?>
    </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>
</body>
</html>
