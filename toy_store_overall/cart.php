<?php

include 'components/connect.php';

session_start();

// User authentication
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   if(is_numeric($cart_id)){
      $delete_cart_item = $conn->prepare("DELETE FROM `order_items` WHERE id = ? AND user_id = ?");
      $delete_cart_item->execute([$cart_id, $user_id]);
      $message[] = 'Cart item deleted!';
   } else {
      $message[] = 'Invalid cart item!';
   }
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `order_items` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   $message[] = 'Deleted all from cart!';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `order_items` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'Cart quantity updated!';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

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
   <h3>shopping cart</h3>
   <p><a href="index.php">Home</a> <span> / Cart</span></p>
</div>

<!-- shopping cart section starts  -->

<section class="products">

   <h1 class="title">Your Cart</h1>

   <div class="box-container">

      <?php
         $grand_total = 0;

         $select_cart = $conn->prepare("SELECT t.id AS toyID, t.name, t.price, t.image, t.stock_quantity, oi.id AS order_item_id, oi.quantity AS orderqty
         from order_items oi
         JOIN toys t ON oi.toy_id = t.id
         where oi.user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
               $quantity = $fetch_cart['orderqty'];
               $sub_total = $fetch_cart['price'] * $quantity;
               $grand_total += $sub_total;
         ?>

      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="<?= $fetch_cart['order_item_id']; ?>">
         <a href="quick_view.php?id=<?= $fetch_cart['toyID']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('Delete this item?');"></button>
         <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
         <div class="name"><?= $fetch_cart['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_cart['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="<?= $fetch_cart['stock_quantity']; ?>" value="<?= $fetch_cart['orderqty']; ?>" maxlength="2">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> Sub total : <span>$<?= $sub_total; ?>/-</span> </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">Your cart is empty</p>';
         }
      ?>

   </div>

   <div class="cart-total">
      <p>Cart total : <span>$<?= $grand_total; ?></span></p>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Proceed to checkout</a>
   </div>

   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">Delete all</button>
      </form>
      <a href="products.php" class="btn">Continue Shopping</a>
   </div>

</section>

<!-- shopping cart section ends -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>