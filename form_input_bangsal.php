<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Laporan Bangsal</title>
</head>
<body>
    <center>
        <h2>INPUT DATA BANGSAL</h2>
        <form action="insert_data.php" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required><br><br>
        
            <label for="ranap_bpjs">Ranap BPJS:</label>
            <input type="number" id="ranap_bpjs" name="ranap_bpjs" required><br><br>
        
            <label for="ranap_umum">Ranap Umum:</label>
            <input type="number" id="ranap_umum" name="ranap_umum" required><br><br>
        
            <label for="rawat_bpjs">Rawat BPJS:</label>
            <input type="number" id="rawat_bpjs" name="rawat_bpjs" required><br><br>
        
            <label for="rawat_umum">Rawat Umum:</label>
            <input type="number" id="rawat_umum" name="rawat_umum" required><br><br>
        
            <label for="meninggal">Meninggal:</label>
            <input type="number" id="meninggal" name="meninggal" required><br><br>
        
            <label for="rujuk">Rujuk:</label>
            <input type="number" id="rujuk" name="rujuk" required><br><br>
        
            <input type="submit" value="Submit">
            <input type="hidden" name="process_type" value="bangsal">
        </form>
    </center>
</body>
</html>
