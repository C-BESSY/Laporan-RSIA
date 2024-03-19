<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../../db.php';

    $process_type = $_POST["process_type"] ?? "";

    if ($process_type === "vk") {
        $tanggal = $_POST["tanggal"];
        $nama_tindakan = $_POST["nama_tindakan"];
        $rm_pasien = $_POST["rm_pasien"];
        $jenis_bayar = $_POST["jenis_bayar"];

        try {
            $query = "INSERT INTO VK(Tanggal, Nama_Tindakan, RM_Pasien, Jenis_Bayar)
                        VALUE (:tanggal, :rm_pasien, :nama_tindakan, :rm_pasien, :jenis_bayar)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":nama_tindakan", $nama_tindakan);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":jenis_bayar", $jenis_bayar);
            $stmt->execute();

            header("Location: ./../laporan_umum.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ./umum/form_input.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type === "perina") {
        $tanggal = $_POST["tanggal"];
        $nama_tindakan = $_POST["nama_tindakan"];
        $rm_pasien = $_POST["rm_pasien"];
        $kelahiran = $_POST["kelahiran"];
        $jenis_bayar = $_POST["jenis_bayar"];

        try {
            $query = "INSERT INTO perina(Tanggal, RM_Pasien, Nama_Tindakan, Kelahiran, Jenis_Bayar)
                        VALUE (:tanggal, :rm_pasien, :nama_tindakan, :kelahiran, :jenis_bayar)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":nama_tindakan", $nama_tindakan);
            $stmt->bindParam(":kelahiran", $kelahiran);
            $stmt->bindParam(":jenis_bayar", $jenis_bayar);
            $stmt->execute();

            header("Location: ./../laporan_perina.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ./perina/form_input_perina.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type === "bangsal") {
        $tanggal = $_POST["tanggal"];
        $rm_pasien = $_POST["rm_pasien"];
        $ranapbpjs = $_POST["ranap_bpjs"];
        $ranapumum = $_POST["ranap_umum"];
        $rawatbpjs = $_POST["rawat_bpjs"];
        $rawatumum = $_POST["rawat_umum"];
        $meninggal = $_POST["meninggal"];
        $rujuk = $_POST["rujuk"];

        try {
            $query = "INSERT INTO bangsal(Tanggal, RM_Pasien, RanapBPJS, RanapUmum, RawatBPJS, RawatUmum, Meninggal, Rujuk)
                        VALUES (:tanggal, rm_pasien, :ranapbpjs, :ranapumum, :rawatbpjs, :rawatumum, :meninggal, :rujuk)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":ranapbpjs", $ranapbpjs);
            $stmt->bindParam(":ranapumum", $ranapumum);
            $stmt->bindParam(":rawatbpjs", $rawatbpjs);
            $stmt->bindParam(":rawatumum", $rawatumum);
            $stmt->bindParam(":meninggal", $meninggal);
            $stmt->bindParam(":rujuk", $rujuk);
            $stmt->execute();

            header("Location: ./../laporan_bangsal.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ./bangsal/form_input_bangsal.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type == 'bangsal_harian') {
        $tanggal = $_POST['tanggal'];
        $rm_pasien = $_POST["rm_pasien"];
        $tindakan = $_POST['tindakan'];
        $keadaan = $_POST['keadaan'];

        $ranapbpjs = 0;
        $ranapumum = 0;
        $rawatbpjs = 0;
        $rawatumum = 0;
        $meninggal = 0;
        $rujuk = 0;

        switch ($tindakan) {
            case 'ranapbpjs':
                $ranapbpjs = 1;
                break;
            case 'ranapumum':
                $ranapumum = 1;
                break;
            case 'rawatbpjs':
                $rawatbpjs = 1;
                break;
            case 'rawatumum':
                $rawatumum = 1;
                break;
        }
        switch ($keadaan) {
            case 'meninggal':
                $meninggal = 1;
                break;
            case 'rujuk':
                $rujuk = 1;
                break;
        }
        try {
            $query = "INSERT INTO bangsal (Tanggal, RM_Pasien, RanapBPJS, RanapUmum, RawatBPJS, RawatUmum, Meninggal, Rujuk)
                    VALUE (:tanggal, :rm_pasien, :ranapbpjs, :ranapumum, :rawatbpjs, :rawatumum, :meninggal, :rujuk)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":ranapbpjs", $ranapbpjs);
            $stmt->bindParam(":ranapumum", $ranapumum);
            $stmt->bindParam(":rawatbpjs", $rawatbpjs);
            $stmt->bindParam(":rawatumum", $rawatumum);
            $stmt->bindParam(":meninggal", $meninggal);
            $stmt->bindParam(":rujuk", $rujuk);
            $stmt->execute();

            header("Location: ./../laporan_bangsal.php?status=success");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    } elseif ($process_type == 'tindakan_sc') {
        $tanggal = $_POST['tanggal'];
        $rm_pasien = $_POST["rm_pasien"];
        $jenis_bayar = $_POST['jenis_bayar'];
        $dehisensi = $_POST['dehisensi'];

        try {
            $query = "INSERT INTO tindakan_ok (Tanggal, RM_Pasien, TindakanUtama, TindakanSekunder, JenisBayarUtama, JenisBayarSekunder, Dehisensi)
                        VALUES (:tanggal, :rm_pasien, 'SC', '', :jenis_bayar, '', :dehisensi)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":jenis_bayar", $jenis_bayar);
            $stmt->bindParam(":dehisensi", $dehisensi);
            $stmt->execute();

            header("Location: ../laporan_tindakan_ok.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ../tindakan/form_input_sc.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type == "tindakan_sc_sekunder") {
        $tanggal = $_POST["tanggal"];
        $jenis_bayar_utama = $_POST["jenis_bayar_utama"];
        $tindakan_sekunder = $_POST["tindakan_sekunder"];
        $jenis_bayar_sekunder = $_POST["jenis_bayar_sekunder"];
        $dehisensi = $_POST["dehisensi"];

        try {
            $query = "INSERT INTO tindakan_ok (Tanggal, TindakanUtama, TindakanSekunder, JenisBayarUtama, JenisBayarSekunder, Dehisensi)
                        VALUES (:tanggal, 'SC', :tindakan_sekunder, :jenis_bayar_utama, :jenis_bayar_sekunder, :dehisensi)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":tindakan_sekunder", $tindakan_sekunder);
            $stmt->bindParam(":jenis_bayar_utama", $jenis_bayar_utama);
            $stmt->bindParam(":jenis_bayar_sekunder", $jenis_bayar_sekunder);
            $stmt->bindParam(":dehisensi", $dehisensi);
            $stmt->execute();

            header("Location: ../laporan_tindakan_ok.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ../tindakan/form_input_sc_sekunder.php?status=error&message=" . urlencode($e->getMessage()));
        }
    } elseif ($_POST["process_type"] == "tindakan_umum") {
        $tanggal = $_POST["tanggal"];
        $rm_pasien = $_POST["rm_pasien"];
        $jenis_bayar_utama = $_POST["jenis_bayar_utama"];
        $tindakan_utama = $_POST["tindakan_utama"];
        $dehisensi = $_POST["dehisensi"];
        
        try {
            $query = "INSERT INTO tindakan_ok (Tanggal, RM_Pasien, TindakanUtama, JenisBayarUtama, Dehisensi) 
                      VALUES (:tanggal, :rm_pasien, :tindakan_utama, :jenis_bayar_utama, :dehisensi)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":tindakan_utama", $tindakan_utama);
            $stmt->bindParam(":jenis_bayar_utama", $jenis_bayar_utama);
            $stmt->bindParam(":dehisensi", $dehisensi);
            $stmt->execute();
    
            header("Location: ../laporan_tindakan_ok.php?status=success");
            exit();
        } catch(PDOException $e){
            header("Location: ../form_input_tindakan.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    }
    else {
        echo "Invalid process type!";
        exit();
    }
} else {
    header("Location: ../../../index.php");
    exit();
}
