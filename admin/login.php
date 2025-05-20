<?php
  include("./config/connection.php");
  session_start();

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hãy cân nhắc sử dụng phương thức băm an toàn hơn như bcrypt.
    
    if ($username == 'admin' && $password == md5('123456')) { // Thay 'your_custom_password' bằng mật khẩu tùy chỉnh của bạn.
        $_SESSION['admin'] = $username;
        header("location:index.php");
    } else {
        $checkLogin = 'Tài khoản hoặc mật khẩu không chính xác!';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập Admin</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css?v=2">
</head>

<body>
  <div id="login">
    <div id="login-box">
      <h2>Đăng nhập tài khoản Admin</h2>

      <p class="text-danger">
        <?php if (isset($checkLogin)) echo $checkLogin; ?>
      </p>

      <form method="POST" action="">
        <div class="form-group">
          <label for="username">Tên đăng nhập:</label>
          <input type="text" id="username" class="form-control" name="username" required>
        </div>

        <div class="form-group">
          <label for="password">Mật khẩu:</label>
          <input type="password" id="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn-login" name="login">ĐĂNG NHẬP</button>
      </form>
    </div>
  </div>
</body>
</html>
