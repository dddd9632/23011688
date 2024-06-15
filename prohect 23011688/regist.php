<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="prjregist.css">
  <title>Sign Up</title>
</head>
<body>
  <?php
  session_start();
  if (isset($_SESSION['username'])) {
    echo "<script>
      alert('You are already logged in.');
      window.location.href = '../main/index.php';
      </script>";
  } else { ?>
    <div class="container">
      <h1>Create Account</h1>
      <form action="regist_proc.php" method="post" class="signup-form">
        <p><input type="text" name="fullname" placeholder="Full Name"></p>
        <p><input type="text" name="user_id" placeholder="id"></p>
        <p><input type="hidden" name="id_check"></p>
        <p><input type="password" name="password" placeholder="Password"></p>
        <p><input type="text" name="email_local" placeholder="Email" style="width:210px;"> @
          <select name="email_domain" style="width:165px;">
            <option value="naver.com">naver.com</option>
            <option value="gmail.com">gmail.com</option>
            <option value="daum.net">daum.net</option>
          </select>
        </p>
        <p><input type="text" name="phone_number" placeholder="Phone Number"></p>
        <p><span style='color:red; font-size:13px;'>Enter 11 digits without "-"</span></p>
        <p><input type="submit" value="Register" class="submit-btn"></p>
        <p><a href="prjlogin.php" style="color: gray; font-size:13px;">Log In</a></p>
      </form>
    </div>
  <?php } ?>
</body>
</html>
