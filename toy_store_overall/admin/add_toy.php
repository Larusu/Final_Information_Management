<?php

session_start();

include '../components/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category = $_POST['category'] ?? '';
    $imageName = basename($_FILES['image']['name']);
    $imageTmp = $_FILES['image']['tmp_name'];
    $targetDir = '../uploaded_img/';
    $targetPath = $targetDir . $imageName;
    $allowedTypes = ['image/jpeg', 'image/png'];
    $fileType = mime_content_type($imageTmp);

    if (!in_array($fileType, $allowedTypes)) {
        die("Only JPG and PNG files are allowed.");
    }
   
    if (move_uploaded_file($imageTmp, $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO toys (name, description, price, image, stock_quantity, category)
                                VALUES (:name, :description, :price, :image, :stock_quantity, :category)");
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':image' => $imageName,
            ':stock_quantity' => $stock_quantity,
            ':category' => $category,
        ]);

        echo "Toy added successfully!";
    } else {
        echo "Failed to upload image.";
    }
    
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

<?php include 'includes/headers.php';?>
<body>

<section class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add Toy</h3>
        <input type="text" name="name" placeholder="Name" class="box" maxlength="100" required><br><br>
        <textarea name="description" placeholder="Description" class="box" required></textarea><br><br>
        <input type="number" name="price" placeholder="Price ($)" class="box" step="0.01" required><br><br>
        <input type="number" name="stock_quantity" placeholder="Stock Quantity ($)" class="box" min="0" required><br><br>
        <select name="category" id="category" placeholder="Category" class="box" required>
            <option value="">--Select Category--</option>
            <option value="Plush">Plush</option>
            <option value="Costumes">Costumes</option>
            <option value="Collectibles">Collectibles</option>
            <option value="Figures">Figures</option>
        </select>
        <br><br><br>
        <label class="custom-upload box">Upload Image
        <input type="file" name="image" accept="image/*" required style="display:none;">
        </label> <br><br>
        <button type="submit" class="delete-btn">Add Toy</button>
    </form>
</section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>