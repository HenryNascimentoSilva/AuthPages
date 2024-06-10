<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Font -->
  <title>Login Page</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Login</h4>
          </div>
          <div class="card-body">
            <form id="loginForm" action="login.php" method="post">
              <div class="form-group">
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" required />
              </div>
              <div class="form-group">
                <input type="password" id="password" class="form-control" placeholder="Password" name="password" required />
              </div>
              <div class="form-check mb-3 d-flex justify-content-between">
                <input class="form-check-input" type="checkbox" value="" id="Remember" checked />
                <label class="form-check-label" for="Remember">
                  Remember me
                </label>

                <a href="#">Forgot Password?</a>
              </div>
              <button type="submit" class="btn btn-primary btn-block font-weight-bold" name="login">
                Sign In
              </button>
              <hr />
              <div class="d-flex justify-content-center">
                <p class="d-flex">Don't have an account?</p>
                <a href="register.php" class="d-flex mx-2">Sign up</a>
              </div>
            </form>
            <div id="status" class="mt-1 d-flex justify-content-center"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Include jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
$conn = mysqli_connect("localhost", "root", "", "usersdb");

if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "SELECT password FROM users WHERE username = '$username'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  
  if ($row != null || $row != false) {
    $dbpass = $row['password'];
    $hashtest = password_verify($password, $dbpass);
    if($hashtest){
      echo "Logado com sucesso";
    } else {
      echo "Acesso negado!";
    }
  }
  else {
    echo "User doesn't exists!";
  }
}

mysqli_close($conn);
?>