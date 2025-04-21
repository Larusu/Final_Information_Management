<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

$select_cart = $conn->prepare("SELECT t.id AS toyID, t.stock_quantity, t.name AS toy_name, t.price, oi.quantity AS orderqty
            FROM order_items oi
            JOIN toys t ON oi.toy_id = t.id
            WHERE oi.user_id = ?");
         $select_cart->execute([$user_id]);
         $cart_data = $select_cart->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $order_number = 'ORD' . strtoupper(uniqid());
   $order_date = date('Y-m-d H:i:s');
   $shipping_fee = 50.00; 
   $payment_status = 'unpaid';
   $fulfillment_status = 'processing';
   $order_summary = $_POST['order_summary'];
   $order_summary = filter_var($order_summary, FILTER_SANITIZE_STRING);

   $check_cart = $conn->prepare("SELECT * FROM `order_items` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      if($address == ''){
         $message[] = 'Please add your address!';
      }else{
         
         $insert_order = $conn->prepare("INSERT INTO `orders`(order_number, user_id, order_date, shipping_fee, total_price, payment_status, fulfillment_status, method, order_summary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $insert_order->execute([$order_number, $user_id, $order_date, $shipping_fee, $total_price, $payment_status, $fulfillment_status, $method, $order_summary]);

         foreach ($cart_data as $item) {
            $toy_id = $item['toyID'];
            $order_qty = $item['orderqty'];
   
            // Get current stock
            $get_stock = $conn->prepare("SELECT stock_quantity FROM `toys` WHERE id = ?");
            $get_stock->execute([$toy_id]);
            $stock_row = $get_stock->fetch(PDO::FETCH_ASSOC);
   
            if ($stock_row) {
               $current_stock = $stock_row['stock_quantity'];
               $new_quantity = $current_stock - $order_qty;
   
               if ($new_quantity >= 0) {
                  // Update stock
                  $update_stock = $conn->prepare("UPDATE `toys` SET stock_quantity = ? WHERE id = ?");
                  $update_stock->execute([$new_quantity, $toy_id]);
               } else {
                  // Not enough stock
                  $message[] = "Not enough stock for toy ID: $toy_id. Available: $current_stock, Requested: $order_qty";
                  continue; // Skip updating this toy
               }
            }
         }
         
         $clear_cart = $conn->prepare("DELETE FROM `order_items` WHERE user_id = ?");
         $clear_cart->execute([$user_id]);

         $message[] = 'Order placed successfully!';
         $_SESSION['admin_messages'][] = 'A new order has been placed by user ID: '.$user_id;
      }
      
   }else{
      $message[] = 'Your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Check out</h3>
   <p><a href="index.php">Home</a> <span> / Checkout</span></p>
</div>

<section class="checkout">

   <h1 class="title">order summary</h1>

<form action="" method="post">

   <div class="cart-items">
      <h3>cart items</h3>
      <?php
         $grand_total = 0;
         $cart_items = [];
         $fetch_profile = [];
         $toy_names = [];
         $order_summary = 'Walang laman! :('; 

         $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_user->execute([$user_id]);
         if ($select_user->rowCount() > 0) {
            $fetch_profile = $select_user->fetch(PDO::FETCH_ASSOC);
         }

         if($select_cart->rowCount() > 0){
            foreach ($cart_data as $items){
               $cart_items[] = $items['toy_name'].' ('.$items['price'].' x '. $items['orderqty'].') - ';
               $grand_total += ($items['price'] * $items['orderqty']);
               $toy_names[] = $items['toy_name']; // store only the name
      ?>
      <p><span class="name"><?= $items['toy_name']; ?></span><span class="price">$<?= $items['price']; ?> x <?= $items['orderqty']; ?></span></p>
      <?php
            }
            $order_summary = implode(', ', $toy_names); // correct place
         }else{
            echo '<p class="empty">Your cart is empty!</p>';
            $order_summary = 'No items'; // fallback if cart is empty
         }
      ?>
      <p class="grand-total"><span class="name">Total :</span><span class="price">$<?= $grand_total; ?></span></p>
      <a href="cart.php" class="btn">View cart</a>
   </div>

   <input type="hidden" name="total_products" value="<?= $total_products; ?>">
   <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
   <input type="hidden" name="name" value="<?= $fetch_profile['username'] ?>">
   <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
   <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
   <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">
   <input type="hidden" name="order_summary" value="<?= htmlspecialchars($order_summary); ?>">

   <div class="user-info">
      <h3>your info</h3>
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['username'] ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
      <a href="update_profile.php" class="btn">update info</a>
      <h3>delivery address</h3>
      <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_address.php" class="btn">update address</a>
      <select name="method" class="box" required>
         <option value="" disabled selected>select payment method --</option>
         <option value="cod">Cash On Delivery</option>
         <option value="creditcard">Credit Card</option>
         <option value="gcash">Gcash</option>
         <option value="paypal">Paypal</option>
      </select>
      <input type="submit" value="place order" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
   </div>

</form>
   
</section>









<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->






<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>