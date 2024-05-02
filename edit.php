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
        <title>Edit a Journal</title>
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
                        <h3 class="txt-h1 fw-bold">Edit your Log</h3>
                        <?php while ($row = $q->fetch(PDO::FETCH_ASSOC)) { ?>
                            <form method="post" action="edit.php">
                                <div class="mb-3 mt-5">
                                    <label class="form-label fs-5 fw-semibold">Title</label>
                                    <input type="text" name="title" class="form-control" required value="<?= $row['title'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fs-5 fw-semibold">Date</label>
                                    <input type="date" name="date" class="form-control" required value="<?= $row['log_date'] ?>">
                                </div>
                                <div class=" mb-3">
                                    <label class="form-label fs-5 fw-semibold">Log</label>
                                    <textarea type="text" rows="6" name="log" class="form-control" required><?= $row['log'] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col text-end">
                                        <input type="button" value="Cancel" onclick="window.location.href='home.php';" class="btn btn-secondary fw-semibold">
                                        <input type="submit" value=" Save " class="btn btn-success fw-semibold ms-3">
                                    </div>
                                </div>
                                <input type="hidden" name="log_id" value="<?= $log_id ?>">
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'assets/inc/script.php' ?>
    </body>

    </html>

<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=logbin', 'root', '');
    $title = $_POST['title'];
    $date = $_POST['date'];
    $log = $_POST['log'];
    $log_id = $_POST['log_id'];

    $q = $pdo->prepare("SELECT title,log_date,log FROM log WHERE user_id=? AND log_id=?");
    $q->execute([$user_id, $log_id]);
    $row = $q->fetch(PDO::FETCH_ASSOC);

    if ($row && ($row['title'] != $title || $row['log_date'] != $date || $row['log'] != $log)) {
        $sql = "update log SET title = ?, log_date = ?, log = ? WHERE user_id=? AND log_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute([$title, $date, $log, $user_id, $log_id]);
    }
    header('location: home.php');

?>
<?php
} else {
    echo "Bad Request";
}
?>