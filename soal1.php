<?php
session_start();

$step = isset($_POST['step']) ? (int) $_POST['step'] : 1;

if ($step === 1 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['jumlah_baris'] = $_POST['jumlah_baris'];
    $_SESSION['jumlah_kolom'] = $_POST['jumlah_kolom'];
    $step = 2;
} elseif ($step === 2 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['data'] = $_POST['data'];
    $step = 3;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 1</title>
    <style>
        .ml-20 {
            margin-left: 20px;
        }

        .text-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php if ($step === 1): ?>
        <!-- Page 1 -->
        <form method="post">
            <label>Inputkan Jumlah Baris:</label>
            <input type="number" name="jumlah_baris" required>
            <span class="ml-20">Contoh : 1</span>
            <br><br>

            <label>Inputkan Jumlah Kolom:</label>
            <input type="number" name="jumlah_kolom" required>
            <span class="ml-20">Contoh : 3</span>
            <br><br>

            <input type="hidden" name="step" value="1">
            <button type="submit">SUBMIT</button>
        </form>

    <?php elseif ($step === 2): ?>
        <!-- Page 2 -->
        <form method="post">
            <?php
            $baris = $_SESSION['jumlah_baris'];
            $kolom = $_SESSION['jumlah_kolom'];

            for ($i = 1; $i <= $baris; $i++) {
                for ($j = 1; $j <= $kolom; $j++) {
            ?>
                    <label class="text-bold"><?= $i . "." . $j ?> : </label>
                    <input type="text"
                        name="data[<?= $i ?>][<?= $j ?>]"
                        required>
            <?php
                }
                echo "<br><br>";
            }
            ?>
            <input type="hidden" name="step" value="2">
            <button type="submit">SUBMIT</button>
        </form>


    <?php elseif ($step === 3): ?>
        <!-- Page 3 -->
        <?php
        $baris = $_SESSION['jumlah_baris'];
        $kolom = $_SESSION['jumlah_kolom'];
        $data = $_SESSION['data'];

        for ($i = 1; $i <= $baris; $i++) {
            for ($j = 1; $j <= $kolom; $j++) {
        ?>
                <p><?= $i . "." . $j . " : " . htmlspecialchars($data[$i][$j]) ?></p>
        <?php
            }
        }
        ?>
    <?php endif; ?>
</body>

</html>