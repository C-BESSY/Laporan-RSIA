<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Tindakan SC</title>
</head>
<body>
    <center>
        <h2>Form Input Tindakan SC</h2>
        <form action="../insert_data.php" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required><br><br>

            <label for="rm_pasien">Rekam Medis:</label>
            <input type="text" name="rm_pasien" id="rm_pasien" placeholder="Masukkan Nomor Rekam Medik" required><br><br>

            <label for="jenis_bayar">Jenis Bayar:</label>
            <select name="jenis_bayar" id="jenis_bayar" required>
                <option value="BPJS">BPJS</option>
                <option value="Umum">Umum</option>
            </select><br><br>

            <label for="dehisensi">Dehisensi:</label>
            <select name="dehisensi" id="dehisensi" required>
                <option value="Ada">Ada</option>
                <option value="Tidak Ada">Tidak Ada</option>
            </select><br><br>

            <a href="../../laporan_tindakan_ok.php"><button type="button">Kembali</button></a>
            <input type="submit" value="Submit">
            <input type="hidden" name="process_type" id="tindakan_sc" value="tindakan_sc">
        </form>
    </center>
</body>
</html>
