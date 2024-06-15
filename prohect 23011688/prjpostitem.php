<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "project");

if ($_POST) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        $sql = "INSERT INTO item (name, description, price, image, user_id) VALUES ('$title', '$description', '$price', '$imgContent', '$user_id')";

        if (mysqli_query($db, $sql)) {
            echo "<script>
                    alert('New record created successfully');
                    window.location.href = 'prjindex.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . mysqli_error($db) . "');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Image upload failed!');
                window.history.back();
              </script>";
    }
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Item</title>

    <link rel="stylesheet" href="prjpostitem.css">
</head>
<body>
    <div class="container">
        <h1>Post Item</h1>
        <form action="prjpostitem.php" method="post" enctype="multipart/form-data" class="post-form">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>

            <button type="submit">Post Item</button>
        </form>
    </div>
</body>
</html>
