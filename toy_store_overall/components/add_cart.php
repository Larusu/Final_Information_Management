<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
      exit;
   }

   $pid = htmlspecialchars(trim($_POST['pid']));
   $price = htmlspecialchars(trim($_POST['price']));
   $qty = $_POST['quantity'] ?? 1;

   // Check toy's stock_quantity first
   $stock_check = $conn->prepare("SELECT stock_quantity FROM toys WHERE id = ?");
   $stock_check->execute([$pid]);
   $toy = $stock_check->fetch(PDO::FETCH_ASSOC);

   if(!$toy){
      $message[] = 'Toy not found!';
   } elseif($toy['stock_quantity'] <= $qty){
      $message[] = 'Not enough stock available!';
   } else {

      $check_cart_numbers = $conn->prepare("SELECT * FROM `order_items` WHERE toy_id = ? AND user_id = ?");
      $check_cart_numbers->execute([$pid, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'Item already in cart!';
      } else {
         $insert_cart = $conn->prepare("INSERT INTO `order_items`(user_id, toy_id, quantity, price) VALUES(?, ?, ?, ?)");
         $insert_cart->execute([$user_id, $pid, $qty, $price]);
         $last_insert_id = $conn->lastInsertId();

         $message[] = 'Added to cart!';

         $access_toys = $conn->prepare("SELECT t.id AS toyID, t.name 
            FROM order_items oi
            JOIN toys t ON oi.toy_id = t.id
            WHERE oi.id = ?");
         $access_toys->execute([$last_insert_id]);
         $get_toy_name = $access_toys->fetch(PDO::FETCH_ASSOC);
      }

   }
}
?>
