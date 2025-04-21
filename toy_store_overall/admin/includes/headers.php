<?php
if(isset($message)){
    foreach($message as $message){
       echo '
       <div class="message">
          <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>
       ';
    }
 }
?>

<header class="header">
    <section class="flex">

        <a href="admin.php" class="logo">Admin</a>

        <nav class="navbar">
            <a href="admin.php">Home</a>
            <a href="order_history.php">Order History</a>
            <a href="add_toy.php">Add Toy</a>
            <a href="../index.php">Customer Tab</a>
        </nav>
    </section>
</header>