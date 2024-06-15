<?php
session_start();


$db = mysqli_connect("localhost", "root", "", "project");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    $query = "SELECT * FROM project WHERE id='$id' AND pw='$pw'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['name'] = $user['name']; 
        echo "<script>
        alert(\"login success!\");
        location.href = \"prjindex.php\";
        </script>";
    } 
}
?>

<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="prjlogin.css">
</head>
<body>
    <?php if (!isset($_SESSION['name']))?>
    <div id="login_wrap" class="wrap">
        <div>
            <h1>Login</h1>
            <form action="prjlogin.php" method="post" name="loginform" id="login_form" class="form">
                <p><input type="text" name="id" id="id" placeholder="ID" required></p>
                <span class="err_id"></span>
                <p><input type="password" name="pw" id="pw" placeholder="Password" required></p>
                <span class="err_pw"></span>
                <p><input type="submit" value="Login" class="form_btn"></p>
                <p class="pre_btn"><a href="regist.php">Sign Up</a></p>
            </form>
        </div>
    </div>

</body>
</html>

