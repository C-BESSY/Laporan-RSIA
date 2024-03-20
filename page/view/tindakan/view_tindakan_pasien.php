<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindakan Pasien</title>
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
    echo "<h3>Detail Tindakan Pasien</h3>";

    $sql = "SELECT * FROM view_tindakan_pasien";
    $result = $conn->query($sql);

    echo "<table border='1'>
            <tr>
            <th>Nomor Rekam Medis</th>
            <th>Tindakan Utama</th>
            <th>Jumlah Tindakan Utama</th>
            <th>Tindakan Sekunder</th>
            <th>Jumlah Tindakan Sekunder</th>
            <th>Tanggal</th>
            </tr>";

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["RM_Pasien"] . "</td>";
            echo "<td>" . $row["Tindakan_Utama"] . "</td>";
            echo "<td>" . $row["Jumlah_Tindakan_Utama"] . "</td>";
            echo "<td>" . $row["Tindakan_Sekunder"] . "</td>";
            echo "<td>" . $row["Jumlah_Tindakan_Sekunder"] . "</td>";
            echo "<td>" . $row["Tanggal"] . "</td>";
        }
    } else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
    }

    $conn = null;
    ?>
</body>
</html>