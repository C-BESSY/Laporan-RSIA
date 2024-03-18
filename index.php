<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <a href="form_input.php"><button>Input Data</button></a>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tahun'])) {
    require_once 'db.php';

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

    <br><br><h2>LAPORAN PERINA</h2>
    <a href="form_input_perina.php"><button>Input Data Perina</button></a>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once 'db.php';

    if (isset($_GET["tahun"])) {
        $tahun = $_GET["tahun"];

        $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                SUM(CASE WHEN Kelahiran = 'Lahir' THEN 1 ELSE 0 END) AS Bayi_Lahir,
                SUM(CASE WHEN Kelahiran = 'Meninggal' THEN 1 ELSE 0 END) AS Bayi_Meninggal,
                SUM(CASE WHEN Nama_Tindakan = 'IUFD' THEN 1 ELSE 0 END) AS IUFD,
                SUM(CASE WHEN Nama_Tindakan = 'RUJUK' THEN 1 ELSE 0 END) AS Rujuk,
                SUM(CASE WHEN Nama_Tindakan = 'BBLR' THEN 1 ELSE 0 END) AS BBLR
            FROM Perina
            WHERE YEAR(Tanggal) = :tahun
            GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tahun', $tahun, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>";
        echo "<tr><th>Bulan</th><th>Bayi Lahir</th><th>Bayi Meninggal</th><th>IUFD</th><th>Rujuk</th><th>BBLR</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['Bulan'] . "</td>";
            echo "<td>" . $row['Bayi_Lahir'] . "</td>";
            echo "<td>" . $row['Bayi_Meninggal'] . "</td>";
            echo "<td>" . $row['IUFD'] . "</td>";
            echo "<td>" . $row['Rujuk'] . "</td>";
            echo "<td>" . $row['BBLR'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

    <h4>RANAP ANAK & PERINA</h4>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once "db.php";

    if (isset($_GET["tahun"])) {
        $tahun = $_GET["tahun"];

        $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                SUM(CASE WHEN Nama_Tindakan = 'RANAP_Anak' AND Jenis_Bayar = 'BPJS' THEN 1 ELSE 0 END) AS Anak_BPJS,
                SUM(CASE WHEN Nama_Tindakan = 'RANAP_Anak' AND Jenis_Bayar = 'Umum' THEN 1 ELSE 0 END) AS Anak_Umum,
                SUM(CASE WHEN Nama_Tindakan = 'RANAP_Perina' AND Jenis_Bayar = 'BPJS' THEN 1 ELSE 0 END) AS Perina_BPJS,
                SUM(CASE WHEN Nama_Tindakan = 'RANAP_Perina' AND Jenis_Bayar = 'Umum' THEN 1 ELSE 0 END) AS Perina_Umum
            FROM perina
            WHERE YEAR(Tanggal) = :tahun AND (Nama_Tindakan = 'RANAP_Anak' OR Nama_Tindakan = 'RANAP_Perina')
            GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tahun', $tahun, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>";
        echo "<tr><th rowspan = '2'>Bulan</th><th colspan='2'>Anak</th><th colspan='2'>Perina</th></tr>";
        echo "<tr><th>BPJS</th><th>Umum</th><th>BPJS</th><th>Umum</th></tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['Bulan'] . "</td>";
            echo "<td>" . $row['Anak_BPJS'] . "</td>";
            echo "<td>" . $row['Anak_Umum'] . "</td>";
            echo "<td>" . $row['Perina_BPJS'] . "</td>";
            echo "<td>" . $row['Perina_Umum'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

    <br><br><h2>LAPORAN BANGSAL RSIA IBUNDA</h2>
    <a href="form_input_bangsal.php"><button>Input Laporan Bangsal</button></a>
    <a href="form_input_bangsal_harian.php"><button>Input Laporan Harian</button></a>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once "db.php";
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
        echo "<tr> <th rowspan = '2'>Bulan</th> <th rowspan = '2'>BPJS</th> <th rowspan = '2'>Umum</th> <th colspan = '2'>Perawatan</th> <th rowspan = '2'>Total Pasien</th> <th rowspan = '2'>Meninggal</th> <th rowspan = '2'>Rujuk</th>
        </tr>";
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
}
?>
</body>
</html>
