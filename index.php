<!-- Login -->

<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header('Location: home.php');
    die();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=logbin', 'root', '');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = $pdo->prepare("select * from login where username=? and password=?");
    $q->execute([$username, $password]);
    $berhasil = $q->fetch(PDO::FETCH_ASSOC);

    if ($berhasil) {
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = $berhasil['user_id'];
        header('Location: home.php');
    } else {
        $error = 'Username or password is incorrect';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to LogBin!</title>
    <?php include 'assets/inc/css.php' ?>
</head>

<body>
    <section id="login">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-5 text-center shadow-sm border p-5">
                    <h3>LogBin</h3>
                    <img src="assets/img/logo.svg" class="mt-4 mb-4 img-fluid">
                    <h4>Let's always be happy!</h4>
                </div>
                <div class="col-5 shadow-sm border p-5">
                    <h3>Hi Buddies!</h3>
                    <form action="index.php" method="post">
                        <div class="mb-3 mt-5">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <!-- jika salah password or error -->
                        <?php if (isset($error)) {
                            echo "<div class='form-text text-danger'>$error</div>";
                        } ?>

                        <div class="text-center mt-3">
                            <a href="register.php">Don’t have an account? Register now!</a>
                        </div>
                        <div class="d-grid gap-2 mt-5">
                            <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'assets/inc/script.php' ?>
</body>

</html>