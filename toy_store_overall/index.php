<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Order Online</span>
               <h3>A feast for otaku souls!</h3>
               <a href="products.php" class="btn">see items</a>
            </div>
            <div class="image">
               <img src="images/home-img-11.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Order Online</span>
               <h3>The Ultimate Alisa Plushie!</h3>
               <a href="products.php" class="btn">see items</a>
            </div>
            <div class="image">
               <img src="images/home-img-12.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Order Online</span>
               <h3>Cosplay so rare, it's legendary!</h3>
               <a href="products.php" class="btn">see items</a>
            </div>
            <div class="image">
               <img src="images/home-img-13.png" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title">merch category</h1>

   <div class="box-container">

      <a href="category.php?category=Figures" class="box">
         <img src="images/doll.png" alt="">
         <h3>Figures and dolls</h3>
      </a>

      <a href="category.php?category=Collectibles" class="box">
         <img src="images/action-figure.png" alt="">
         <h3>Toys and Collectibles</h3>
      </a>

      <a href="category.php?category=Costumes" class="box">
         <img src="images/cosplay.png" alt="">
         <h3>Apparel and Cosplay</h3>
      </a>

      <a href="category.php?category=Plush" class="box">
         <img src="images/plushies.png" alt="">
         <h3>Plushies</h3>
      </a>

   </div>

</section>




<section class="products">

   <h1 class="title">latest releases</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `toys` oRDER BY created_at DESC LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>

      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <div class="quantity"><span>Qty:</span><?= $fetch_products['stock_quantity']; ?></div>
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="products.php" class="btn">View all</a>
   </div>
   
</section>


















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>