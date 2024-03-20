<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien VK</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    include '../../../db.php';
    echo "<h3>Detail Pasien VK</h3>";
    $sql = "SELECT * FROM view_umum_pasien";
    $result = $conn->query($sql);

    echo "<table border='1'>
        <tr>
        <th>Tanggal</th>
        <th>Nomor Rekam Medis</th>
        <th>Tindakan</th>
        </tr>";

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["Tanggal"] . "</td>";
            echo "<td>" . $row["RM_Pasien"] . "</td>";
            echo "<td>" . $row["Nama_Tindakan"] . "</td>";
        }
    } else {
        echo "<tr> <td collspan='8'>Tidak Ada Data</td> </tr>";
    }

    $conn = null;
    ?>
</body>
</html>