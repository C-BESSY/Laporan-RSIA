<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan Umum</title>
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
<a href="../index.php"><button>DASHBOARD</button></a>
    <center>
        <h2>LAPORAN BULANAN RSIA IBUNDA</h2>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="tahun">Pilih Tahun:</label>
            <select name="tahun" id="tahun">
                <?php
                    $tahun_sekarang = date("Y");
                    for ($tahun = 2010; $tahun <= $tahun_sekarang; $tahun++) {
                        $selected = ($tahun == $tahun_sekarang) ? 'selected' : '';
                        echo "<option value=\"$tahun\" $selected>$tahun</option>";
                    }
                    ?>
            </select>
            <input type="submit" value="Tampilkan">
        </form><br>
    </center>

    <a href="view/umum/view_umum_pasien.php"><button>Detail Pasien</button></a>
    <a href="./form/umum/form_input.php"><button>Input Data</button></a>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tahun'])) {
        require_once './../db.php';

        $tahun = $_GET["tahun"];

        $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                    SUM(CASE WHEN Nama_Tindakan = 'Operasi' THEN 1 ELSE 0 END) AS Operasi,
                    SUM(CASE WHEN Nama_Tindakan = 'Lab' THEN 1 ELSE 0 END) AS Lab,
                    SUM(CASE WHEN Nama_Tindakan = 'RInap' THEN 1 ELSE 0 END) AS RInap,
                    SUM(CASE WHEN Nama_Tindakan = 'Konsultasi' THEN 1 ELSE 0 END) AS Konsultasi
                FROM VK
                WHERE YEAR(Tanggal) = :tahun
                GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tahun', $tahun, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $final_result = array();

        foreach ($result as $row) {
            $bulan = $row['Bulan'];
            if (!isset($final_result[$bulan])) {
                $final_result[$bulan] = array(
                    'Operasi' => 0,
                    'Lab' => 0,
                    'RInap' => 0,
                    'Konsultasi' => 0,
                );
            }

            $final_result[$bulan]['Operasi'] += $row['Operasi'];
            $final_result[$bulan]['Lab'] += $row['Lab'];
            $final_result[$bulan]['RInap'] += $row['RInap'];
            $final_result[$bulan]['Konsultasi'] += $row['Konsultasi'];
        }

        echo "<table>";
        echo "<tr><th>Bulan</th><th>Operasi</th><th>Lab</th><th>Rawat Inap</th><th>Konsultasi</th></tr>";
        foreach ($final_result as $bulan => $data) {
            echo "<tr>";
            echo "<td>" . $bulan . "</td>";
            echo "<td>" . $data['Operasi'] . "</td>";
            echo "<td>" . $data['Lab'] . "</td>";
            echo "<td>" . $data['RInap'] . "</td>";
            echo "<td>" . $data['Konsultasi'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Silakan pilih tahun untuk melihat laporan.</p>";
    }
?>
</body>
</html>
