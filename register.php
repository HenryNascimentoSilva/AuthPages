<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Page</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Register</h4>
          </div>
          <div class="card-body">
            <form id="registrationForm" method="post" action="register.php">
              <div class="form-group">
                <input type="text" id="username" class="form-control" placeholder="Username" name="username" required />
              </div>
              <div class="form-group">
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" required />
              </div>
              <div class="form-group">
                <input type="password" id="password" class="form-control" placeholder="Password" name="password" required />
              </div>
              <div class="form-group">
                <input type="password" id="confirm-password" class="form-control" placeholder="Confirm Password" name="confirm-password" required />
              </div>
              <button type="submit" name="register" class="btn btn-primary btn-block font-weight-bold">
                Sign In
              </button>
              <hr>
              <div class="d-flex justify-content-center">
                <p>Already have an account?</p>
                <a href="login.php" class="mx-2">Sign In</a>
              </div>
            </form>
            <div id="status" class="mt-2"></div>
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

if (isset($_POST['register'])) {

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $confirm = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);

  $hash = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";

  if ($confirm == $password) {
    try {
      mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception) {
      echo "Username or email already taken";
    }
  }
}
mysqli_close($conn);
?>