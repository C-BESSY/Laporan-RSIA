<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Harian</title>
</head>
<body>
    <center>
        <h2>INPUT DATA BANGSAL HARIAN</h2>
        <form action="insert_data.php" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal"><br><br>
            <label for="tindakan">Tindakan:</label>
            <select name="tindakan" id="tindakan">
                <option value="ranapbpjs">Ranap BPJS</option>
                <option value="ranapumum">Ranap Umum</option>
                <option value="rawatbpjs">Rawat BPJS</option>
                <option value="rawatumum">Rawat Umum</option>
            </select required><br><br>
            <label for="keadaan">Keadaan:</label>
            <select name="keadaan" id="keadaan">
                <option value="baik"> </option>
                <option value="rujuk">Rujuk</option>
                <option value="meninggal">Meninggal</option>
            </select><br><br>
            <input type="submit" value="Sumbit">
            <input type="hidden" name="process_type" value="bangsal_harian">
        </form>
    </center>
</body>
</html>
