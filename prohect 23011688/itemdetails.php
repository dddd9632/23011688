<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "project");

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    $query = "SELECT item.name AS item_name, item.description, item.price, item.image, 
                     project.name AS user_name, project.email, project.number 
              FROM item 
              JOIN project ON item.user_id = project.id 
              WHERE item.id = $item_id";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($db));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Item not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $user_name = $_SESSION['name'];
    $comment = $_POST['comment'];

    $insert_query = "INSERT INTO comments (item_id, user_name, comment) VALUES ('$item_id', '$user_name', '$comment')";
    mysqli_query($db, $insert_query);
}

$comments_query = "SELECT user_name, comment FROM comments WHERE item_id = $item_id";
$comments_result = mysqli_query($db, $comments_query);

mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['item_name']; ?> - Item Details</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }
        header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2rem;
        }
        main {
            padding: 2rem;
            background-color: #f9f9f9;
        }
        .item-details, .user-details, .comments-section {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .item-details img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            margin-bottom: 1rem;
            border-radius: 8px 8px 0 0;
        }
        h2 {
            color: #343a40;
            font-size: 1.75rem;
        }
        p {
            margin: 0.5rem 0;
            color: #666;
        }
        .comment-form input, .comment-form textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .comment-form button {
            padding: 0.5rem 1rem;
            border: none;
            background-color: #343a40;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <header>
        <h1><?php echo $row['item_name']; ?></h1>
    </header>
    <main>
        <div class="item-details">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="item image" />
            <h2><?php echo $row['item_name']; ?></h2>
            <p><?php echo $row['description']; ?></p>
            <p>Price: $<?php echo $row['price']; ?></p>
        </div>
        <div class="user-details">
            <h2>Seller Information</h2>
            <p>Name: <?php echo $row['user_name']; ?></p>
            <p>Email: <?php echo $row['email']; ?></p>
            <p>Phone Number: <?php echo $row['number']; ?></p>
        </div>
        <div class="comments-section">
            <h2>Comments</h2>
            <form class="comment-form" action="" method="post">
                <input type="hidden" name="user_name" value="<?php echo $_SESSION['name']; ?>">
                <p><?php echo $_SESSION['name']; ?></p>
                <textarea name="comment" placeholder="Your Comment" required></textarea>
                <button type="submit">Submit</button>
            </form>
            <?php
            if (mysqli_num_rows($comments_result) > 0) {
                while ($comment_row = mysqli_fetch_assoc($comments_result)) {
                    echo "<div class='comment'>";
                    echo "<p><strong>" . $comment_row['user_name'] . "</strong></p>";
                    echo "<p>" . $comment_row['comment'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No comments yet.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
