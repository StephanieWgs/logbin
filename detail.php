<?php
include 'assets/inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $log_id = $_GET['log_id'];
    $q = $pdo->prepare("SELECT * FROM log WHERE user_id=? AND log_id=?");
    $q->execute([$user_id, $log_id]);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Log</title>
        <?php include 'assets/inc/css.php' ?>
    </head>

    <body>
        <?php include 'assets/inc/navbar.php' ?>

        <div class="container mt-4 mb-3">
            <div class="row">
                <div class="col">
                    <h3 class="txt-h1 fw-bold">Detail Log</h3>
                </div>
                <div class="col text-end">
                    <input type="button" value="  Back  " onclick="window.location.href='home.php';" class="btn btn-secondary fw-semibold">
                </div>
            </div>
            <div class="row mt-4 ">
                <div class="card border border-1 border-success p-0">
                    <?php while ($row = $q->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="card-header px-4 py-3">
                            <h3 class="txt-h1"><?= $row['title'] ?></h3>
                            <h6 class="txt-h1"><?= $row['log_date'] ?></h6>
                        </div>
                        <div class="card-body px-4 py-3 mt-3">
                            <p><?= $row['log'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php include 'assets/inc/script.php' ?>
    </body>

    </html>

<?php
} else {
    echo "Bad Request";
}
?>