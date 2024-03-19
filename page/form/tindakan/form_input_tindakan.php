<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Tindakan Umum</title>
</head>
<body>
    <center>
    <h2>Form Input Tindakan Umum</h2>
    <form action="../insert_data.php" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required><br><br>

        <label for="rm_pasien">Rekam Medis:</label>
        <input type="text" name="rm_pasien" id="rm_pasien" placeholder="Masukkan Nomor Rekam Medik" required><br><br>

        <label for="jenis_bayar_utama">Jenis Bayar:</label>
        <select name="jenis_bayar_utama" id="jenis_bayar_utama" required>
            <option value="BPJS">BPJS</option>
            <option value="Umum">Umum</option>
        </select><br><br>

        <label for="tindakan_utama">Tindakan Utama:</label>
        <select name="tindakan_utama" id="tindakan_utama" required>
            <option value="SC">SC</option>
            <option value="KISTEKTOMI">KISTEKTOMI</option>
            <option value="MIOMEKTOMI">MIOMEKTOMI</option>
        </select><br><br>

        <label for="dehisensi">Dehisensi:</label>
        <select name="dehisensi" id="dehisensi" required>
            <option value="Ada">Ada</option>
            <option value="Tidak Ada">Tidak Ada</option>
        </select><br><br>

        <a href="../../laporan_tindakan_ok.php"><button type="button">Kembali</button></a>
        <input type="submit" value="Submit">
        <input type="hidden" name="process_type" value="tindakan_umum">
    </form>
    </center>
</body>
</html>
