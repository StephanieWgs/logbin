<?php
include 'assets/inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create a Journal</title>
        <?php include 'assets/inc/css.php' ?>
    </head>

    <body>
        <?php include 'assets/inc/navbar.php' ?>

        <div class="container mt-4 mb-3">
            <div class="row">
                <div class="col text-end">
                    <input type="button" value="  Back  " onclick="window.location.href='home.php';" class="btn btn-secondary fw-semibold">
                </div>
            </div>
            <div class="row mt-4 ">
                <div class="card border border-1 border-success p-0 mb-4">
                    <div class="card-body px-4 py-3 mt-3">
                        <h3 class="txt-h1 fw-bold">What do you wanna write today?</h3>
                        <form method="post" action="create.php">
                            <div class="mb-3 mt-5">
                                <label class="form-label fs-5 fw-semibold">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-5 fw-semibold">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class=" mb-3">
                                <label class="form-label fs-5 fw-semibold">Log</label>
                                <textarea type="text" rows="6" name="log" class="form-control" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <input type="button" value="Cancel" onclick="window.location.href='home.php';" class="btn btn-secondary fw-semibold">
                                    <input type="submit" value=" Save " class="btn btn-success fw-semibold ms-3">
                                </div>
                            </div>
                            <input type="hidden" name="log_id" value="<?= $log_id ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'assets/inc/script.php' ?>
    </body>

    </html>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $log = $_POST['log'];
    $sql = 'insert into log(title, log_date, log,user_id) values(?, ?, ?, ?)';
    $q = $pdo->prepare($sql);
    $q->execute([$title, $date, $log, $user_id]);
    header('location: home.php');

?>
<?php
} else {
    echo "Bad Request";
}
?>