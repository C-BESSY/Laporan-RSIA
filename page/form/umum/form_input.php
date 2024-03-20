<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Input</title>
</head>
<body>
    <center>
        <h2>INPUT LAPORAN</h2>
        <form action="../insert_data.php" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" required><br><br>
            <label for="rm_pasien">Rekam Medis:</label>
            <input type="text" name="rm_pasien" id="rm_pasien" placeholder="Masukkan Nomor Rekam Medik" required><br><br>
            <label for="nama_tindakan">Nama Tindakan:</label>
            <select name="nama_tindakan" id="nama_tindakan">
                <?php
                include "../../../db.php";
                $query = "SELECT DISTINCT Nama_Tindakan FROM VK";
                $stmt = $conn->query($query);
                $tindakan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tindakan_list as $tindakan) {
                    echo "<option value=\"" . $tindakan['Nama_Tindakan'] . "\">" . $tindakan['Nama_Tindakan'] . "</option>";
                }
                ?>
            </select required><br><br>
            <label for="jenis_bayar">Jenis Bayar:</label>
            <select name="jenis_bayar" id="jenis_bayar">
                <option value="Umum">Umum</option>
                <option value="BPJS">BPJS</option>
            </select><br><br>
            <a href="../../laporan_umum.php"><button type="button">Kembali</button></a>
            <input type="submit" value="Submit">
            <input type="hidden" name="process_type" value="vk">
        </form>
    </center>
</body>
</html>
