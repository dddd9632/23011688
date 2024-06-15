<?php
session_start();
$database = mysqli_connect("localhost", "root", "", "project_db");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = $_POST['title'];
    $itemDescription = $_POST['description'];
    $itemPrice = $_POST['price'];
    $currentUserId = $_SESSION['user_id'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageContent = file_get_contents($_FILES['image']['tmp_name']);
        $imageDataEscaped = mysqli_real_escape_string($database, $imageContent);

        $insertQuery = "INSERT INTO items (name, description, price, image, user_id) VALUES ('$itemName', '$itemDescription', '$itemPrice', '$imageDataEscaped', '$currentUserId')";

        if (mysqli_query($database, $insertQuery)) {
            echo "<script>
                    alert('Record added successfully.');
                    window.location.href = 'prjindex.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error adding record.');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error uploading image.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
</head>
<body>
    <header>
        <h1>Add New Item</h1>
    </header>
    <main>
        <form action="post_item.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>

            <button type="submit">Add Item</button>
        </form>
    </main>
</body>
</html>
