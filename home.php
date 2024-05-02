<?php
date_default_timezone_set('Asia/Jakarta');

include 'assets/inc/db.php';

$q = $pdo->query("select * from log WHERE user_id= $user_id"); //query log

$m = $pdo->query("select * from mood WHERE user_id= $user_id"); // query mood


// Variabel untuk menyimpan jumlah kemunculan masing-masing mood
$jlhMood = array(
    'happy' => 0,
    'calm' => 0,
    'neutral' => 0,
    'sad' => 0,
    'angry' => 0
);

while ($jenisMood = $m->fetch(PDO::FETCH_ASSOC)) {
    switch ($jenisMood['mood']) {
        case 1:
            $jlhMood['happy']++;
            break;
        case 2:
            $jlhMood['calm']++;
            break;
        case 3:
            $jlhMood['neutral']++;
            break;
        case 4:
            $jlhMood['sad']++;
            break;
        case 5:
            $jlhMood['angry']++;
            break;
    }
}

$today = date('Y-m-d');
$l = $pdo->prepare("SELECT mood FROM mood WHERE mood_date = CURRENT_DATE AND user_id= ?");
$l->execute([$user_id]);
$rowMood = $l->fetch(PDO::FETCH_ASSOC);
if ($rowMood === true) {
    $today_mood = $rowMood['mood'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <?php include 'assets/inc/css.php' ?>
</head>

<body>
    <?php include 'assets/inc/navbar.php' ?>

    <section id="top">
        <div class="container mt-4 mb-3">
            <div class="row justify-content-center">
                <div class="col-4 text-center">
                    <div class="row align-items-center">
                        <div class="col text-start">
                            <p class="txt-h1 fw-bold mb-0">Moddie Tracker</p>
                        </div>
                        <div class="col text-end" id="periodSelect">
                            <select class="form-select" id="periodSelector" onchange="updateChart()">
                                <option value="week">Weekly</option>
                                <option value="month">Monthly</option>
                                <option value="year">Yearly</option>
                            </select>
                        </div>
                    </div>
                    <!-- Grafik Mood -->
                    <div class="row mt-3">
                        <div class="card-body">
                            <canvas id="grafikMood" height="50px" width="50px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 ms-5">
                    <h3 class="txt-h1 fw-bold">How was your day?</h3>
                    <p class="txt-h1"><?= date("l, j F Y") ?></p>
                    <div class="container text-center p-0 ">
                        <div class="row row-cols-auto" id="moodBar">
                            <div class="col <?php if ($today_mood == 1) echo 'choose' ?>" onclick="sendMood(1)">
                                <img src="assets/img/happy.svg" class="img-fluid">
                                <p>Happy</p>
                            </div>
                            <div class="col <?php if ($today_mood == 2) echo 'choose' ?>" onclick="sendMood(2)">
                                <img src="assets/img/calm.svg" class="img-fluid">
                                <p>Calm</p>
                            </div>
                            <div class="col <?php if ($today_mood == 3) echo 'choose' ?>" onclick="sendMood(3)">
                                <img src="assets/img/neutral.svg" class="img-fluid">
                                <p>Neutral</p>
                            </div>
                            <div class="col <?php if ($today_mood == 4) echo 'choose' ?>" onclick="sendMood(4)">
                                <img src="assets/img/sad.svg" class="img-fluid">
                                <p>Sad</p>
                            </div>
                            <div class="col <?php if ($today_mood == 5) echo 'choose' ?>" onclick="sendMood(5)">
                                <img src="assets/img/angry.svg" class="img-fluid">
                                <p>Angry</p>
                            </div>
                        </div>
                    </div>

                    <form method="get" action="create.php">
                        <div class="d-grid gap-2 mt-3 col-6">
                            <input type="submit" value="Create a Journal" class="btn btn-success fw-semibold">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="bottom">
        <div class="container my-5">
            <div class="card border border-1 border-success">
                <div class="card-header px-4 py-3">
                    <h3 class="txt-h1">Log</h3>
                </div>
                <div class="card-body px-4 py-3 mt-3">
                    <!-- tabel data -->
                    <table id="tabel" class="table table-striped my-3" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-start">Date</th>
                                <th>Title</th>
                                <th>Overview</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td class="text-start"><?= $row['log_date']; ?></td>
                                    <td><?= $row['title']; ?></td>
                                    <td><?= substr($row['log'], 0, 30); ?>...</td>
                                    <td class="text-center">
                                        <form action="detail.php" method="get">
                                            <input type="hidden" name="log_id" value="<?= $row['log_id']; ?>">
                                            <input type="submit" value="Detail" class="btn btn-secondary fw-semibold">
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="edit.php" method="get" style="display: inline-block;">
                                            <input type="hidden" name="log_id" value="<?= $row['log_id']; ?>">
                                            <input type="submit" value="  Edit  " class="btn btn-warning fw-semibold">
                                        </form>
                                        <!-- Modal Trigger -->
                                        <input type="submit" value="Delete" class="btn btn-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#delete" onclick="setLogId(<?= $row['log_id']; ?>)">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- akhir tabel -->
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <h5>Delete Your Log?</h5>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal"> No ! </button>
                    <form action="delete.php" method="post">
                        <input id="logIdInput" type="hidden" name="log_id" value="">

                        <button type="submit" class="btn btn-primary fw-semibold">Yes :(</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'assets/inc/script.php' ?>

    <!-- Kirim Period -->
    <script>
        const selectElement = document.getElementById('selectPeriod');

        function fetchData() {
            const selectedValue = selectElement.value;
            fetch(`/api/data?period=${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    // Handle the fetched data, for example, update the HTML
                    dataContainer.innerHTML = JSON.stringify(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        fetchData();
    </script>


    <!-- Add Shadow pada Mood yang Dipilih-->
    <script>
        function sendMood(moodId) {
            var moodButtons = document.querySelectorAll('#moodBar .col');
            moodButtons.forEach(function(button) {
                button.classList.remove('choose');
            });

            var selectedButton = document.querySelector('#moodBar .col:nth-child(' + moodId + ')');
            selectedButton.classList.add('choose');

            addToChart(moodId);

            fetch(`/logbin/api/data.php?push=` + moodId);
        }
    </script>


    <!-- Tabel -->
    <script>
        new DataTable('#tabel');

        function setLogId(log_id) {
            document.getElementById('logIdInput').value = log_id;
        }
    </script>

    <!-- Grafik -->
    <script>
        const ctx = document.getElementById('grafikMood');

        let chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Happy', 'Calm', 'Neutral', 'Sad', 'Angry'],
                datasets: [{
                    data: [
                        <?= $jlhMood['happy'] ?>,
                        <?= $jlhMood['calm'] ?>,
                        <?= $jlhMood['neutral'] ?>,
                        <?= $jlhMood['sad'] ?>,
                        <?= $jlhMood['angry'] ?>
                    ],
                    backgroundColor: ['#FC9802', '#FECD66', '#FEF2CC', '#83C5DD', '#F67579'],
                }],
            },
        });
    </script>


    <!-- Update Chart berdasarkan periode -->
    <script>
        let ctxx = document.getElementById('grafikMood');
        let selector = document.getElementById("periodSelector");

        let updateChart = () => {
            let selectorValue = selector.value;
            fetch(`/logbin/api/data.php?period=` + selectorValue)
                .then(response => response.json())
                .then(data => {
                    let newData = [0, 0, 0, 0, 0];

                    Object.entries(data).forEach((entry) => {
                        newData[entry[1]["mood"] - 1] = entry[1]["count"]
                    })

                    console.log(data);
                    console.log(chart.data.datasets[0].data);
                    console.log(newData);

                    chart.data.datasets[0].data = newData
                    chart.update()

                })
                .catch(error => console.error('Error fetching data:', error));
        }

        let prev_added = -1;
        let addToChart = (moodId) => {
            let current = Array.from(chart.data.datasets[0].data);

            if (prev_added != -1) {
                current[prev_added] = current[prev_added] - 1;
            }

            current[moodId - 1] = current[moodId - 1] + 1;
            prev_added = moodId - 1;

            chart.data.datasets[0].data = current;
            chart.update();
        };
    </script>


</body>

</html>