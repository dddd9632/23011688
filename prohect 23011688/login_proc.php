<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "project");

$id = $_POST['id'];
$pw = $_POST['pw'];

$sql = "SELECT * FROM project WHERE id='$id'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>
        alert('No matching ID found.');
        history.back();
        </script>";
    exit;
} else {
    if ($row['pw'] != $pw) {
        echo "<script>
            alert('Incorrect password.');
            history.back();
            </script>";
        exit;
    } else {
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: prjindex.php");
        exit;
    }
}
?>
