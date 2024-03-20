<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien Bangsal</title>
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
    echo "<h3>Detail Pasien Bangsal</h3>";

    $sql = "SELECT * FROM view_bangsal_pasien";
    $result = $conn->query($sql);

    echo "<table border='1'>
        <tr>
        <th>Tanggal</th>
        <th>Nomor Rekam Medis</th>
        <th>Ranap BPJS</th>
        <th>Ranap Umum</th>
        <th>Rawat BPJS</th>
        <th>Rawat Umum</th>
        <th>Meninggal</th>
        <th>Rujuk</th>
        </tr>";

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["Tanggal"] ."</td>";
            echo "<td>" . $row["RM_Pasien"] ."</td>";
            echo "<td>" . $row["RanapBPJS"] . "</td>";
            echo "<td>" . $row["RanapUmum"] . "</td>";
            echo "<td>" . $row["RawatBPJS"] . "</td>";
            echo "<td>" . $row["RawatUmum"] . "</td>";
            echo "<td>" . $row["Meninggal"] . "</td>";
            echo "<td>" . $row["Rujuk"] . "</td>";
        }
    } else {
        echo "<tr> <td colspan='8'>Tidak Ada Data</td> </tr>";
    }

    $conn = null;
    ?>
</body>
</html>