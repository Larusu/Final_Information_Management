<?php

include 'includes/db.php';

session_start(); // Start the session

if (isset($_SESSION['admin_messages'])) {
    foreach ($_SESSION['admin_messages'] as $admin_msg) {
       echo '
       <div class="message admin">
          <span>' . $admin_msg . '</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>';
    }
}

if (isset($_POST['delete']) && isset($_POST['toy_id'])) {
    $toy_id = $_POST['toy_id'];

    if (is_numeric($toy_id)) {
        $delete_toy = $pdo->prepare("DELETE FROM toys WHERE id = ?");
        $delete_toy->execute([$toy_id]);
        $message[] = 'Toy deleted successfully!';
    } else {
        $message[] = 'Invalid toy ID!';
    }
}

if (isset($_POST['update_qty'])) {
    $toy_id = $_POST['toy_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $update_qty = $pdo->prepare("UPDATE toys SET stock_quantity = ?, price = ? WHERE id = ?");
    $update_qty->execute([$qty, $price, $toy_id]);

    $message[] = 'Toy stock quantity updated successfully!';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toy Store</title>

    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/your-kit-id.js">
</head>

<body>

<?php include 'includes/headers.php';?>

    <section class="products">

        <h1 class="title">Products</h1>

        <div class="box-container">

        <?php
            $select_products = $pdo->prepare("SELECT * FROM `toys` ORDER BY created_at DESC");
            $select_products->execute();
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>

        <form action="" method="post" class="box">
            <input type="hidden" name="toy_id" value="<?= $fetch_products['id']; ?>">

            <img src="../uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="<?= htmlspecialchars($fetch_products['name']); ?>">
            <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>
            <p><?= htmlspecialchars($fetch_products['description']); ?></p>

            <div class="flex">
                <p>Price: <?= $fetch_products['price']; ?></p>
                <input type="number" name="price" class="qty" min="1" max="999999" value="<?= $fetch_products['price']; ?>" maxlength="7" step="0.01">
                <p>Qty: <?= $fetch_products['stock_quantity']; ?></p>
                <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_products['stock_quantity']; ?>" maxlength="3">
                <button type="submit" class="fas fa-trash" name="delete" onclick="return confirm('Delete the product? ')"></button>
            </div>

            <button type="submit" name="update_qty" class="btn" onclick="return confirm('Change the quantity?')">Change</button>
        </form>

        <?php
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>

        </div>

    </section>





<?php include 'includes/footer.php'; ?>

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