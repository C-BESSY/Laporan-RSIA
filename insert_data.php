<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db.php';

    $process_type = $_POST["process_type"] ?? "";

    if ($process_type === "vk") {
        $tanggal = $_POST["tanggal"];
        $nama_tindakan = $_POST["nama_tindakan"];
        $rm_pasien = $_POST["rm_pasien"];
        $jenis_bayar = $_POST["jenis_bayar"];

        try {
            $query = "INSERT INTO VK(Tanggal, Nama_Tindakan, RM_Pasien, Jenis_Bayar)
                        VALUE (:tanggal, :nama_tindakan, :rm_pasien, :jenis_bayar)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":nama_tindakan", $nama_tindakan);
            $stmt->bindParam(":rm_pasien", $rm_pasien);
            $stmt->bindParam(":jenis_bayar", $jenis_bayar);
            $stmt->execute();

            header("Location: form_input.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: form_input.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type === "perina") {
        $tanggal = $_POST["tanggal"];
        $nama_tindakan = $_POST["nama_tindakan"];
        $kelahiran = $_POST["kelahiran"];
        $jenis_bayar = $_POST["jenis_bayar"];

        try {
            $query = "INSERT INTO perina(Tanggal, Nama_Tindakan, Kelahiran, Jenis_Bayar)
                        VALUE (:tanggal, :nama_tindakan, :kelahiran, :jenis_bayar)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":nama_tindakan", $nama_tindakan);
            $stmt->bindParam(":kelahiran", $kelahiran);
            $stmt->bindParam(":jenis_bayar", $jenis_bayar);
            $stmt->execute();

            header("Location: form_input_perina.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: form_input_perina.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type === "bangsal") {
        $tanggal = $_POST["tanggal"];
        $ranapbpjs = $_POST["ranap_bpjs"];
        $ranapumum = $_POST["ranap_umum"];
        $rawatbpjs = $_POST["rawat_bpjs"];
        $rawatumum = $_POST["rawat_umum"];
        $meninggal = $_POST["meninggal"];
        $rujuk = $_POST["rujuk"];

        try {
            $query = "INSERT INTO bangsal(Tanggal, RanapBPJS, RanapUmum, RawatBPJS, RawatUmum, Meninggal, Rujuk)
                        VALUES (:tanggal, :ranapbpjs, :ranapumum, :rawatbpjs, :rawatumum, :meninggal, :rujuk)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":ranapbpjs", $ranapbpjs);
            $stmt->bindParam(":ranapumum", $ranapumum);
            $stmt->bindParam(":rawatbpjs", $rawatbpjs);
            $stmt->bindParam(":rawatumum", $rawatumum);
            $stmt->bindParam(":meninggal", $meninggal);
            $stmt->bindParam(":rujuk", $rujuk);
            $stmt->execute();

            header("Location: form_input_bangsal.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: form_input_bangsal.php?status=error&message=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($process_type == 'bangsal_harian') {
        $tanggal = $_POST['tanggal'];
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
            $query = "INSERT INTO bangsal (Tanggal, RanapBPJS, RanapUmum, RawatBPJS, RawatUmum, Meninggal, Rujuk)
                    VALUE (:tanggal, :ranapbpjs, :ranapumum, :rawatbpjs, :rawatumum, :meninggal, :rujuk)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":ranapbpjs", $ranapbpjs);
            $stmt->bindParam(":ranapumum", $ranapumum);
            $stmt->bindParam(":rawatbpjs", $rawatbpjs);
            $stmt->bindParam(":rawatumum", $rawatumum);
            $stmt->bindParam(":meninggal", $meninggal);
            $stmt->bindParam(":rujuk", $rujuk);
            $stmt->execute();

            header("Location: form_input_bangsal_harian.php?status=success");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    } else {
        echo "Invalid process type!";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
