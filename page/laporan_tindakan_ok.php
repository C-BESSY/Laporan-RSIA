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
        <h2>LAPORAN TINDAKAN OK</h2>
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

    <a href="form/tindakan/form_input_sc.php"><button>Input Tindakan SC</button></a>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["tahun"])) {
    require "../db.php";
    $tahun = $_GET["tahun"];

    $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                            SUM(CASE WHEN TindakanUtama = 'SC' AND JenisBayarUtama = 'BPJS' THEN 1 ELSE 0 END) AS SC_BPJS,
                            SUM(CASE WHEN TindakanUtama = 'SC' AND JenisBayarUtama = 'Umum' THEN 1 ELSE 0 END) AS SC_Umum,
                            SUM(CASE WHEN TindakanUtama = 'SC' THEN 1 ELSE 0 END) AS SC_Total,
                            SUM(CASE WHEN Dehisensi = 'Ada' THEN 1 ELSE 0 END) AS Dehisensi
                        FROM tindakan_ok
                        WHERE YEAR(Tanggal) = :tahun
                        GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tahun', $tahun, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr> <th rowspan='2'>Bulan</th> <th colspan='2'>SC</th> <th rowspan='2'>TOTAL</th> <th rowspan='2'>DEHISENSI</th> </tr>";
    echo "<tr> <th>BPJS</th> <th>Umum</th> </tr>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Bulan'] . "</td>";
        echo "<td>" . $row['SC_BPJS'] . "</td>";
        echo "<td>" . $row['SC_Umum'] . "</td>";
        echo "<td>" . $row['SC_Total'] . "</td>";
        echo "<td>" . $row['Dehisensi'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?><br><br>

    <a href="form/tindakan/form_input_sc_sekunder.php"><button>Input Tindakan SC & Sekunder</button></a>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tahun'])) {
    require "../db.php";
    $tahun = $_GET["tahun"];

    $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                            SUM(CASE WHEN TindakanUtama = 'SC' AND JenisBayarUtama = 'BPJS' THEN 1 ELSE 0 END) AS SC_utama_BPJS,
                            SUM(CASE WHEN TindakanUtama = 'SC' AND JenisBayarUtama = 'Umum' THEN 1 ELSE 0 END) AS SC_utama_Umum,
                            SUM(CASE WHEN TindakanSekunder = 'MOW' AND JenisBayarSekunder = 'BPJS' THEN 1 ELSE 0 END) AS SC_MOW_BPJS,
                            SUM(CASE WHEN TindakanSekunder = 'MOW' AND JenisBayarSekunder = 'Umum' THEN 1 ELSE 0 END) AS SC_MOW_Umum,
                            SUM(CASE WHEN TindakanSekunder = 'HISTERECTOMI' AND JenisBayarSekunder = 'BPJS' THEN 1 ELSE 0 END) AS SC_HIS_BPJS,
                            SUM(CASE WHEN TindakanSekunder = 'HISTERECTOMI' AND JenisBayarSekunder = 'Umum' THEN 1 ELSE 0 END) AS SC_HIS_Umum,
                            SUM(CASE WHEN Dehisensi = 'Ada' THEN 1 ELSE 0 END) AS Dehisensi_sekunder
                        FROM tindakan_ok
                        WHERE YEAR(Tanggal) = :tahun
                        GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tahun', $tahun, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr> <th rowspan = '3'>Bulan</th> <th colspan = '6'>SC</th>  <th rowspan = '3'>DEHISENSI</th> </tr>";
    echo "<tr> <th rowspan ='2'>BPJS</th> <th rowspan ='2'>Umum</th> <th colspan ='2'>MOW</th> <th colspan ='2'>HISTERECTOMI</th>";
    echo "<tr> <th>BPJS</th> <th>Umum</th> <th>BPJS</th>  <th>Umum</th>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Bulan'] . "</td>";
        echo "<td>" . $row['SC_utama_BPJS'] . "</td>";
        echo "<td>" . $row['SC_utama_Umum'] . "</td>";
        echo "<td>" . $row['SC_MOW_BPJS'] . "</td>";
        echo "<td>" . $row['SC_MOW_Umum'] . "</td>";
        echo "<td>" . $row['SC_HIS_BPJS'] . "</td>";
        echo "<td>" . $row['SC_HIS_Umum'] . "</td>";
        echo "<td>" . $row['Dehisensi_sekunder'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?><br><br>

    <a href="form/tindakan/form_input_tindakan.php"><button>Input Tindakan Umum</button></a>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tahun'])) {
    require "../db.php";
    $tahun = $_GET["tahun"];

    $query = "SELECT DATE_FORMAT(Tanggal, '%b-%y') AS Bulan,
                                SUM(CASE WHEN TindakanUtama = 'SC' AND JenisBayarUtama = 'BPJS' THEN 1 ELSE 0 END) AS SC_utama_BPJS,
                                SUM(CASE WHEN TindakanUtama = 'SC' AND JenisBayarUtama = 'Umum' THEN 1 ELSE 0 END) AS SC_utama_Umum,
                                SUM(CASE WHEN TindakanUtama = 'KISTEKTOMI' AND JenisBayarUtama = 'BPJS' THEN 1 ELSE 0 END) AS KIS_BPJS,
                                SUM(CASE WHEN TindakanUtama = 'KISTEKTOMI' AND JenisBayarUtama = 'Umum' THEN 1 ELSE 0 END) AS KIS_Umum,
                                SUM(CASE WHEN TindakanUtama = 'MIOMEKTOMI' AND JenisBayarUtama = 'BPJS' THEN 1 ELSE 0 END) AS MIOM_BPJS,
                                SUM(CASE WHEN TindakanUtama = 'MIOMEKTOMI' AND JenisBayarUtama = 'Umum' THEN 1 ELSE 0 END) AS MIOM_Umum,
                                SUM(CASE WHEN TindakanUtama IN ('SC', 'KISTEKTOMI', 'MIOMEKTOMI') THEN 1 ELSE 0 END) AS Total,
                                SUM(CASE WHEN Dehisensi = 'Ada' THEN 1 ELSE 0 END) AS Dehisensi
                            FROM tindakan_ok
                            WHERE YEAR(Tanggal) = :tahun
                            GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tahun', $tahun, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>
                                <th rowspan = '2'>Bulan</th>
                                <th colspan = '2'>SC</th>
                                <th colspan = '2'>KISTEKTOMI</th>
                                <th colspan = '2'>MIOMEKTOMI</th>
                                <th rowspan = '2'>TOTAL</th>
                                <th rowspan = '2'>DEHISENSI</th>
                                </tr>";
    echo "<tr>
                                <th >BPJS</th>
                                <th >Umum</th>
                                <th >BPJS</th>
                                <th >Umum</th>
                                <th >BPJS</th>
                                <th >Umum</th>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Bulan'] . "</td>";
        echo "<td>" . $row['SC_utama_BPJS'] . "</td>";
        echo "<td>" . $row['SC_utama_Umum'] . "</td>";
        echo "<td>" . $row['KIS_BPJS'] . "</td>";
        echo "<td>" . $row['KIS_Umum'] . "</td>";
        echo "<td>" . $row['MIOM_BPJS'] . "</td>";
        echo "<td>" . $row['MIOM_Umum'] . "</td>";
        echo "<td>" . $row['Total'] . "</td>";
        echo "<td>" . $row['Dehisensi'] . "</td>";
        echo "</tr>";
    }
    echo "<table/>";
} else {
    echo "<p>Silakan pilih tahun untuk melihat laporan.</p>";
}
?><br><br>

    <!-- <a href="#.php"><button>Input Tindakan</button></a> -->
    <?php
// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//     require "../db.php";
//     if (isset($_GET["tahun"])) {
//         $tahun = $_GET["tahun"];

//         $query = "SELECT DATE_FORMAT(Tanggal, '%b') AS Bulan,
//                                                 SUM(RanapBPJS) AS sum_bpjs,
//                                                 SUM(RanapUmum) AS sum_umum,
//                                                 SUM(RawatBPJS) AS rawat_bpjs,
//                                                 SUM(RawatUmum) AS rawat_umum,
//                                                 SUM(RanapBPJS + RawatBPJS) AS bpjs,
//                                                 SUM(RanapUmum + RawatUmum) AS umum,
//                                                 SUM(RanapBPJS + RanapUmum + RawatBPJS + RawatUmum) AS total_pasien,
//                                                 SUM(Meninggal) AS meninggal,
//                                                     SUM(Rujuk) AS rujuk
//                                             FROM bangsal
//                                             WHERE YEAR(Tanggal) = :tahun
//                                             GROUP BY DATE_FORMAT(Tanggal, '%Y-%m')";
//         $stmt = $conn->prepare($query);
//         $stmt->bindParam(':tahun', $tahun, PDO::PARAM_STR);
//         $stmt->execute();
//         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         echo "<table>";
//         echo "<tr>
//                                     <th rowspan = '3'>Bulan</th>
//                                     <th colspan = '6'>SC</th>
//                                     <th colspan = '2'>KISTEKTOMI</th>
//                                     <th colspan = '2'>MIOMEKTOMI</th>
//                                     <th colspan = '2'>RECLOSING</th>
//                                     <th colspan = '2'>HISTERECTOMI</th>
//                                     <th colspan = '2'>LAPAROTOMI</th>
//                                     <th colspan = '2'>SALPINGO</th>
//                                     <th rowspan = '3'>TOTAL</th>
//                                     <th rowspan = '3'>DEHISENSI</th>
//                                     </tr>";
//         echo "<tr>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>
//                                     <th colspan ='2'>MOW</th>
//                                     <th colspan ='2'>HISTERECTOMI</th>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>
//                                     <th rowspan ='2'>BPJS</th>
//                                     <th rowspan ='2'>Umum</th>";
//         echo "<tr>
//                                     <th>BPJS</th>
//                                     <th>Umum</th>
//                                     <th>BPJS</th>
//                                     <th>Umum</th>";
//         echo "<table/>";
//     }
// }
// ?>
</body>
</html>
