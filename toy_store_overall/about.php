<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
   <h3>about us</h3>
   <p><a href="index.php">Home</a> <span> / About</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img1.png" alt="">
      </div>

      <div class="content">
         <h3>✨ WHY CHOOSE OTAKU OASIS? ✨</h3>
         <p>"Because every otaku deserves their dream loot!"</p>
         <p>🛍️ At Otaku Oasis, we're not just a store—we're your ultimate anime haven! Whether you're hunting for figures, cosplay, or exclusive merch, we've got the best, handpicked by otakus who truly understand the passion. Our shipping is faster than a ninja on a mission, so you won't have to wait an eternity for your treasures to arrive. Plus, we only stock S-rank quality items—no bootlegs, just pure sugoi goodness! More than just a shop, we're a fandom family where anime lovers unite. So what are you waiting for? Level up your collection today!</p>
         <a href="products.php" class="btn">our products</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         <p>Summon your favorite merch like a true anime protagonist! Scroll, click, and let destiny (and our shop) guide your next treasure!</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>Speedier than a ninja on caffeine! We ship your order faster than your favorite character's power-up sequence!</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy your loot</h3>
         <p>Level up your unboxing experience with some tasty treats! Grab some pocky, ramen, or whatever fuels your otaku soul!</p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">customer's reviews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/pic-1.jpg" alt="">
            <p>The moment I unboxed my order, I felt like I was in an anime transformation scene. The quality is insane! This is now my go-to otaku shop!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Kazuya S.</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-2.jpg" alt="">
            <p>I felt like I just unlocked a secret shop in an RPG! The merch quality is top-tier, and the shipping was so fast it felt like teleportation. Will 100% order again!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Rika M.</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-3.jpg" alt="">
            <p>Legit the best anime store ever! Everything arrived in perfect condition, and now my collection looks like an anime museum. Highly recommend!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Haruto T.</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-4.jpg" alt="">
            <p>Finally, a place where my otaku heart feels at home! Got my cosplay, and it fits perfectly. Now I'm ready to slay at the next con! 💖</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Takeshi R.</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-5.jpg" alt="">
            <p>As a hardcore cosplayer, I'm super picky about details, but WOW—this shop delivers perfection! My outfit is chef's kiss. Can't wait to order more!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ren K. </h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-6.jpg" alt="">
            <p>They say happiness can't be bought, but clearly they've never shopped here! My room is now an anime paradise. 10/10 would recommend!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Yumi A.</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>