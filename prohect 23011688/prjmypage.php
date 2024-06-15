<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "project");

$currentUser = $_SESSION['name'];

if ($_POST) {
    $newName = $_POST['name'];
    $newPassword = $_POST['pw'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];

    $sql = "UPDATE project SET name='$newName', pw='$newPassword', email='$newEmail', number='$newPhone' WHERE name='$currentUser'";
    mysqli_query($db, $sql);

    $_SESSION['name'] = $newName;
    $_SESSION['pw'] = $newPassword;
    $_SESSION['email'] = $newEmail;
    $_SESSION['number'] = $newPhone;

    echo "<script>alert('Information updated successfully.'); window.location.href = 'prjindex.php';</script>";
    exit();
}

$sql = "SELECT * FROM project WHERE name='$currentUser'";
$result = mysqli_query($db, $sql);
$userData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit My Info</title>
    <link rel="stylesheet" href="prjmypage.css" />
</head>
<body>
    <h1>Edit My Info</h1>
    <form action="" method="post">
        <p><input type="text" name="name" placeholder="Name" value="<?php echo $userData['name']; ?>"></p>
        <p><input type="password" name="pw" placeholder="Password" value="<?php echo $userData['pw']; ?>"></p>
        <p><input type="text" name="email" placeholder="Email" value="<?php echo $userData['email']; ?>"></p>
        <p><input type="text" name="phone" placeholder="Phone" value="<?php echo $userData['number']; ?>"></p>
        <p><input type="submit" value="Update Info"></p>
    </form>
</body>
</html>
