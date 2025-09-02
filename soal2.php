<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "testdb";

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : "";

$sql = "
    SELECT hobi.hobi, COUNT(DISTINCT person.id) AS jumlah_person
    FROM hobi 
    JOIN person ON person.id = hobi.person_id
";

if (!empty($search)) {
    $sql .= " WHERE hobi.hobi LIKE '%" . $connection->real_escape_string($search) . "%'";
}

$sql .= "GROUP BY hobi.hobi ORDER BY jumlah_person DESC";

$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 2</title>
</head>

<body>
    <h2>Laporan Hobi</h2>

    <!-- Search -->
    <form method="get">
        <input type="text" name="search" placeholder="Cari hobi..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a href="soal2.php">Reset</a>
    </form>
    <br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Hobi</th>
            <th>Jumlah Person</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['hobi']) ?></td>
                <td><?= $row['jumlah_person'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>