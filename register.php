<?php
if (isset($_POST['name']) && isset($_POST['birth_date']) && isset($_POST['username']) && isset($_POST['password'])) {
    $pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=logbin', 'root', '');
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //cek username apakah ada?
    $cek = "SELECT COUNT(*) FROM login WHERE username = ?";
    $cek_stmt = $pdo->prepare($cek);
    $cek_stmt->execute([$username]);
    $ada = $cek_stmt->fetchColumn();

    if ($ada > 0) {
        $error = "Username sudah ada";
    } else {
        $newUser = 'insert into user(name, birth_date) values(?, ?)';
        $qUser = $pdo->prepare($newUser);
        $qUser->execute([$name, $birth_date]);

        $newLogin = 'insert into login(username, password) values(?, ?)';
        $qUser = $pdo->prepare($newLogin);
        $qUser->execute([$username, $password]);

        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'assets/inc/css.php' ?>
    <title>Register</title>
</head>

<body>
    <section id="register">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-5 text-center shadow-sm border p-5">
                    <h3>LogBin</h3>
                    <img src="assets/img/logo.svg" class="mt-4 mb-4 img-fluid">
                    <h4>Let's always be happy!</h4>
                </div>
                <div class="col-5 shadow-sm border p-5">
                    <h3>Become a LogBin Buddy</h3>
                    <form action="register.php" method="post">
                        <div class="mb-3 mt-5">
                            <label class="form-label">Name</label><br>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label><br>
                            <input type="date" name="birth_date" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>

                        <!-- jika username sudah ada -->
                        <?php if (isset($error)) {
                            echo "<div class='form-text text-danger'>$error</div>";
                        } ?>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <input type="submit" value="Register" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include 'assets/inc/script.php' ?>
</body>

</html>