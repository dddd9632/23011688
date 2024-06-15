<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "project");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Goods Trading Site</title>
    <link rel="stylesheet" href="prjindex.css" />
</head>
<body>
    <header>
        <h1>Used Goods Trading Site</h1>
    </header>
    <nav>
        <ul>
            <li><a href="prjindex.php">Home</a></li>
            <?php
if (isset($_SESSION['name'])) {
    echo '<li><a href="prjpostitem.php">Post Item</a></li>';
    echo '<li><a href="prjmypage.php">Edit My Page</a></li>';
    echo '<li><a href="logout.php">Logout</a></li>';
    echo '<li style="color:white;">Hello, ' . $_SESSION['name'] . '!</li>';
} else {
    echo '<li><a href="prjlogin.php">Login</a></li>';
    echo '<li><a href="regist.php">Sign Up</a></li>';
}
?>

        </ul>
    </nav>

    <main>
        <?php if (isset($_SESSION['name'])): ?>
            <h2>Items for Sale</h2>
            <div class="item-container">
            <?php
            $query = "SELECT id, name, description, price, image FROM item";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='item'>";
                    echo "<a href='itemdetails.php?id=" . $row['id'] . "'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='item image' />";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "</a>";
                    echo "</div>";
                }
            } 
            ?>
            </div>
        <?php else: ?>
            <p style="text-align:center;">Please log in to view items. <a href="prjlogin.php">Log in</a></p>
        <?php endif; ?>
    </main>
</body>
</html>
