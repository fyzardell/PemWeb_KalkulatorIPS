<?php
// 1. Buat array multidimensi $matkul (Minimal 5 mata kuliah)
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 85],
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 65],
    ["nama" => "Struktur Data", "sks" => 3, "nilai" => 75],
    ["nama" => "Kalkulus", "sks" => 2, "nilai" => 75],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 90]
];

// 2. Fungsi helper hitungBobot
function hitungBobot($nilai) {
    if ($nilai >= 80) return ["huruf" => "A", "bobot" => 4.0];
    if ($nilai >= 70) return ["huruf" => "B", "bobot" => 3.0];
    if ($nilai >= 60) return ["huruf" => "C", "bobot" => 2.0];
    if ($nilai >= 50) return ["huruf" => "D", "bobot" => 1.0];
    return ["huruf" => "E", "bobot" => 0.0];
}

// Variabel penampung untuk hitung IPS
$total_sks = 0;
$total_bobot_sks = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas PHP - Slide 11</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        /* 4. Beri warna merah pada baris MENGULANG */
        .baris-mengulang { background-color: #ffcccc; color: #990000; }
    </style>
</head>
<body>

    <h2>Hasil Studi Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Matkul</th>
                <th>SKS</th>
                <th>Nilai Angka</th>
                <th>Nilai Huruf</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- 3. Menampilkan data menggunakan foreach -->
            <?php foreach ($matkul as $m): 
                $hasil = hitungBobot($m["nilai"]);
                $status = ($hasil["bobot"] >= 2.0) ? "LULUS" : "MENGULANG";
                
                // Cek class CSS untuk warna merah
                $css_class = ($status == "MENGULANG") ? "baris-mengulang" : "";

                // Akumulasi SKS dan Bobot untuk IPS
                $total_sks += $m["sks"];
                $total_bobot_sks += ($hasil["bobot"] * $m["sks"]);
            ?>
            <tr class="<?= $css_class ?>">
                <td><?= $m["nama"] ?></td>
                <td><?= $m["sks"] ?></td>
                <td><?= $m["nilai"] ?></td>
                <td><?= $hasil["huruf"] ?></td>
                <td><strong><?= $status ?></strong></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php 
    // 5. Hitung Ringkasan IPS (Total (SKS * Bobot) / Total SKS)
    $ips = ($total_sks > 0) ? ($total_bobot_sks / $total_sks) : 0;
    
    // Tentukan batas maksimal SKS semester depan
    $maks_sks = ($ips >= 3.00) ? 24 : 20;
    ?>

    <!-- Menampilkan Ringkasan -->
    <div class="ringkasan">
        <h3>Ringkasan Semester</h3>
        <p><strong>Total SKS Diambil:</strong> <?= $total_sks ?></p>
        <p><strong>Indeks Prestasi Semester (IPS):</strong> <?= number_format($ips, 2) ?></p>
        <p><strong>Maksimal SKS Semester Depan:</strong> <?= $maks_sks ?> SKS</p>
    </div>

</body>
</html>