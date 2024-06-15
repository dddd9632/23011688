<?php
session_start();

$db = mysqli_connect("localhost", "root", "");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($db, "project");

$id = $_POST['user_id'];
$pw = $_POST['password'];
$name = $_POST['fullname'];
$email_local = $_POST['email_local'];
$email_domain = $_POST['email_domain'];
$email = $email_local . '@' . $email_domain;
$number = $_POST['phone_number'];

// 입력 값 검증
if (empty($id) || empty($pw) || empty($name) || empty($email) || empty($number)) {
    die("All fields are required.");
}

// 숫자로 변환할 수 있는지 확인 (현재 구조에서 pw와 number는 int형이므로 숫자로 처리)
if (!is_numeric($pw) || !is_numeric($number)) {
    die("Password and phone number must be numeric.");
}

$query = "INSERT INTO project (name, id, email, pw, number) VALUES ('$name', '$id', '$email', '$pw', '$number')";

$result = mysqli_query($db, $query);

// 쿼리 실행 확인
if (!$result) {
    die("Query failed: " . mysqli_error($db));
}

if ($result) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Success</title>
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            a {
                text-decoration: none;
                color: #000;
            }
            html, body {
                height: 100%;
                margin: 0;
                font-family: Arial, sans-serif;
                background: linear-gradient(black, gray);
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .wrap {
                width: 500px;
                height: auto;
                background-color: #fff;
                border-radius: 20px;
                padding: 30px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .wrap > div {
                width: 100%;
            }
            h1 {
                margin-bottom: 20px;
                font-size: 24px;
            }
            p {
                font-size: 1.2em;
                margin-bottom: 20px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                margin-top: 20px;
                font-size: 1em;
                color: #fff;
                background-color: black;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }
            .button:hover {
                background-color: gray;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <div>
                <h1>Record Added Successfully!</h1>
                <p>Your information has been successfully recorded.</p>
                <a href="prjlogin.php" class="button">Login</a>
                <a href="prjindex.php" class="button">Home</a>
            </div>
        </div>
    </body>
    </html>';
}

mysqli_close($db);
?>
