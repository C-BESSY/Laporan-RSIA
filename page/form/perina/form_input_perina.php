<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Input Perina</title>
</head>
<body>
    <center>
        <H2>INPUT DATA PERINA</H2>
        <form action="../insert_data.php" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" required><br><br>
            <label for="rm_pasien">Rekam Medis:</label>
            <input type="text" name="rm_pasien" id="rm_pasien" placeholder="Masukkan Nomor Rekam Medik" required><br><br>
            <label for="nama_tindakan">Nama Tindakan:</label>
            <select name="nama_tindakan" id="nama_tindakan">
                <?php
                    include "../../../db.php";
                    $query = "SHOW COLUMNS FROM perina LIKE 'Nama_Tindakan'";
                    $stmt = $conn->query($query);
                    $column_info = $stmt->fetch(PDO::FETCH_ASSOC);
                    preg_match_all("/'(.*?)'/", $column_info['Type'], $enum_values);
                    $tindakan_list = $enum_values[1];

                    foreach ($tindakan_list as $tindakan) {
                        echo "<option value=\"" . $tindakan . "\">" . $tindakan . "</option>";
                    }
                ?>
            </select required><br><br>
            <label for="kelahiran">Kelahiran:</label>
            <select name="kelahiran" id="kelahiran">
                <option value="Lahir">Lahir</option>
                <option value="Meninggal">Meninggal</option>
            </select required><br><br>
            <label for="jenis_bayar">Jenis Bayar:</label>
            <select name="jenis_bayar" id="jenis_bayar">
                <option value="Umum">Umum</option>
                <option value="BPJS">BPJS</option>
            </select required><br><br>
            <a href="../../laporan_perina.php"><button type="button">Kembali</button></a>
            <input type="submit" value="Submit">
            <input type="hidden" name="process_type" value="perina">
        </form>
    </center>
</body>
</html>
