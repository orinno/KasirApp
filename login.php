<?php
include 'config.php';
session_start();
// remove all session variables
// session_unset();

// print_r($_SESSION);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //hash password
    $pass = password_hash($password, PASSWORD_DEFAULT);

    //verify password
    password_verify($username, $password);

    $query = mysqli_query($dbconnect, "SELECT * FROM user WHERE username='$username' and password='$password'");

    //mendapatkan hasil dari data
    $data = mysqli_fetch_assoc($query);
    // return var_dump($data);

    //mendapatkan nilai jumlah data
    $check = mysqli_num_rows($query);
    // return var_dump($check);

    if (!$check) {
        $_SESSION['error'] = 'Username & password salah';
    } else {
        $_SESSION['userid'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role_id'] = $data['role_id'];

        header('location:index.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/stylelogin.css">
</head>
<body>

    <!-- LOGIN -->
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="text-align: center; font-size: 2rem; font-weight: 600;">MomskyApp</p>
            <!-- Alert -->
            <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '') { ?>
				<div class="alert alert-danger" role="alert">
					<?=$_SESSION['error']?>
				</div>
			<?php }
				$_SESSION['error'] = '';
			?>         
            <div class="input-group mb-3">
                <input type="text" name="username" placeholder="Username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="input-group mb-3" style="margin-bottom: 10px;">
                <input type="password" name="password" placeholder="Password" id="myInput" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="cekbox">
                <input class="cekbox" type="checkbox" onclick="myFunction()">Show Password
            </div>
            <div class="input-group">
                <button name="login" type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    <!--
    <div class="container box-login">
    <h2>LOGIN HERE</h2>
    <form action="" method="post">
        <div class="container-al46">
            <label for="uname"><b><Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required><br>
            
            
            <input type="password" name="psw" placeholder="Passowrd"  required><br>

            <input type="checkbox" checked="checked"><span>Remember me</span><br>

            <div class="btn">
                <button type="submit">Login</button>
            </div>

            <span class="fpw"><a href="#">Forgot password?</a></span>
        </div>
    </form> 
    </div>
-->
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>