<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
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
        <h2>LAPORAN BANGSAL RSIA IBUNDA</h2>
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

    <a href="view/bangsal/view_bangsal_pasien.php"><button>Detail Pasien Bangsal</button></a>
    <a href="./form/bangsal/form_input_bangsal.php"><button>Input Laporan Bangsal</button></a>
    <a href="./form/bangsal/form_input_bangsal_harian.php"><button>Input Laporan Harian</button></a>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once "../db.php";
        if (isset($_GET["tahun"])) {
            $tahun = $_GET["tahun"];

            $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                                        SUM(RanapBPJS) AS sum_bpjs,
                                        SUM(RanapUmum) AS sum_umum,
                                        SUM(RawatBPJS) AS rawat_bpjs,
                                        SUM(RawatUmum) AS rawat_umum,
                                        SUM(RanapBPJS + RawatBPJS) AS bpjs,
                                        SUM(RanapUmum + RawatUmum) AS umum,
                                        SUM(RanapBPJS + RanapUmum + RawatBPJS + RawatUmum) AS total_pasien,
                                        SUM(Meninggal) AS meninggal,
                                        SUM(Rujuk) AS rujuk
                                    FROM bangsal
                                    WHERE YEAR(Tanggal) = :tahun
                                    GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tahun', $tahun, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<table>";
            echo "<tr> <th rowspan = '2'>Bulan</th> <th rowspan = '2'>BPJS</th> <th rowspan = '2'>Umum</th> <th colspan = '2'>Perawatan</th> <th rowspan = '2'>Total Pasien</th> <th rowspan = '2'>Meninggal</th> <th rowspan = '2'>Rujuk</th> </tr>";
            echo "<tr><th>BPJS</th> <th>Umum</th>";

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['Bulan'] . "</td>";
                echo "<td>" . $row['bpjs'] . "</td>";
                echo "<td>" . $row['umum'] . "</td>";
                echo "<td>" . $row['rawat_bpjs'] . "</td>";
                echo "<td>" . $row['rawat_umum'] . "</td>";
                echo "<td>" . $row['total_pasien'] . "</td>";
                echo "<td>" . $row['meninggal'] . "</td>";
                echo "<td>" . $row['rujuk'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>Silakan pilih tahun untuk melihat laporan.</p>";
    }
    ?>
</body>
</html>