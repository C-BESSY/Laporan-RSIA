<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Tindakan SC & Sekunder</title>
</head>
<body>
    <center>
        <h2>Form Input Tindakan SC & Sekunder</h2>
        <form action="../insert_data.php" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required><br><br>

            <label for="rm_pasien">Rekam Medis:</label>
            <input type="text" name="rm_pasien" id="rm_pasien" placeholder="Masukkan Nomor Rekam Medik" required><br><br>

            <label for="jenis_bayar_utama">Jenis Bayar SC:</label>
            <select name="jenis_bayar_utama" id="jenis_bayar_utama" required>
                <option value="" selected disabled hidden>None</option>
                <option value="BPJS">BPJS</option>
                <option value="Umum">Umum</option>
            </select><br><br>

            <label for="tindakan_sekunder">Tindakan Sekunder:</label>
            <select name="tindakan_sekunder" id="tindakan_sekunder" required>
                <option value="" selected disabled hidden>Pilih</option>
                <option value="MOW">MOW</option>
                <option value="HISTERECTOMI">HISTERECTOMI</option>
            </select><br><br>


            <label for="jenis_bayar_sekunder">Jenis Bayar Sekunder:</label>
            <select name="jenis_bayar_sekunder" id="jenis_bayar_sekunder" required>
                <option value="" selected disabled hidden>None</option>
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
            <input type="hidden" name="process_type" id="tindakan_sc_sekunder" value="tindakan_sc_sekunder">
        </form>
    </center>
</body>
</html>
