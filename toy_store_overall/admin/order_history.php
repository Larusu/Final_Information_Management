<?php
session_start(); // Start the session
include 'includes/db.php';

$stmt = $pdo->prepare("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id");
$stmt->execute();

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
</head>

<body>
    <?php include 'includes/headers.php'; ?>

    <h1 class="title">Order History</h1>
    <table>
        <thead>
            <tr>
                <th>Order No.</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>Payment Status</th>
                <th>Fulfillment Status</th>
                <th>Method</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

         <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
         <?php
               $paymentClass = strtolower($row['payment_status']);
               $fulfillmentClass = strtolower($row['fulfillment_status']);
         ?>
         <tr>
               <td><?= $row['order_number'] ?></td>
               <td><?= $row['order_date'] ?></td>
               <td><?= $row['total_price'] ?></td>
               <td>
                  <span class="status payment clickable-status <?= $paymentClass ?>" 
                     data-order="<?= $row['order_number'] ?>">
                     <?= ucfirst($row['payment_status']) ?>
                  </span>
               </td>
               <td>
                  <span class="status fulfillment clickable-status <?= $fulfillmentClass ?>" 
                     data-order="<?= $row['order_number'] ?>">
                     <?= ucfirst($row['fulfillment_status']) ?>
                  </span>
               </td>
               <td><?= $row['method'] ?></td>
               <td>$<?= number_format($row['total_price'] + $row['shipping_fee'], 2) ?></td>
            </tr>
            <?php endwhile; ?>
        
         </tbody>

    </table>

















<?php include 'includes/footer.php'; ?>





<script>
document.querySelectorAll('.clickable-status').forEach(span => {
    span.addEventListener('click', () => {
        const orderNumber = span.dataset.order;
        const type = span.classList.contains('payment') ? 'payment' : 'fulfillment';
        const currentStatus = span.textContent.trim().toLowerCase();

        // Toggle logic
        let newStatus;
        if (type === 'payment') {
            newStatus = currentStatus === 'paid' ? 'unpaid' : 'paid';
        } else {
            newStatus = currentStatus === 'processing' ? 'delivered' : 'processing';
        }

        fetch('update_status.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                type: type,
                status: newStatus,
                order_number: orderNumber
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                span.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                span.classList.remove(currentStatus);
                span.classList.add(newStatus);
            } else {
                alert('Failed to update: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong!');
        });
    });
});
</script>


</body>
</html>