<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        #kanvas {
            background-color: aliceblue;
            justify-content: center;
            align-items: center;
            display: flex;
            margin: auto;
            position: relative;
        }

        .container {
            width: 500px;
            top: 45%;
            left: 50%;
            padding-top: 50px;
            padding: 10px;
            text-align: center;
            position: absolute;
            display: flex;
            transform: translate(-50%, -50%);
            flex-direction: column;
            align-items: center;
            z-index: 1;
        }

        .header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1px;
        }

        .header a {
            text-decoration: none;
            color: #6666ff;
            padding: 2px 5px;
            margin-left: 10px;
            margin-right: 10px;
            background-color: transparent;
            font-size: 14px;
            cursor: pointer;
            user-select: none;
            border: none;
            text-decoration: underline;
        }

        .header h3 {
            margin: 0;
            font-size: 19px;
            font-weight: normal;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
            height: 35px;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        td {
            background-color: #fff;
            color: #333;
        }

    </style>


</head>

<body>
    
    <div class="container">
        <?php

        //* BAGIAN 1: MENGAMBIL BULAN DAN TAHUN YANG AKAN DITAMPILKAN
        $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('n'); // n = format bulan (1-12)
        $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); // Y = format tahun 4 digit

        //  * BAGIAN 2: PENYESUAIAN BULAN DAN TAHUN
        if ($bulan < 1) {
            $bulan = 12; // Desember
            $tahun--; // Tahun sebelumnya
        } 
        if ($bulan > 12) {
            $bulan = 1; // Januari
            $tahun++; // Tahun berikutnya
        }

        //  * BAGIAN 3: DAFTAR NAMA BULAN
        $nama_bulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        /*
         * BAGIAN 4: MENGHITUNG JUMLAH HARI DALAM BULAN
         * - Fungsi date('t') menghitung jumlah hari dalam bulan tertentu
         * - strtotime mengubah format tanggal menjadi timestamp
        */
        $jumlah_hari = date('t', strtotime("$tahun-$bulan-01")); // Contoh: "2024-05-21"

        /*
         * BAGIAN 5: MENENTUKAN HARI PERTAMA BULAN
         * - date('w') mengembalikan angka 0 (Minggu) sampai 6 (Sabtu)
         * - Menentukan hari apa tanggal 1 jatuh pada bulan tersebut
        */
        $hari_pertama = date('w', strtotime("$tahun-$bulan-01")); // 0=Minggu, 1=Senin, dst
        ?>

        <!-- BAGIAN 6: TAMPILAN KALENDER
        <h3><?php echo $nama_bulan[$bulan-1]." ".$tahun; ?></h3> -->
    
        <!-- 
            BAGIAN 7: TOMBOL NAVIGASI 
            - Tombol "Bulan Sebelumnya" mengurangi nilai bulan
            - Tombol "Bulan Berikutnya" menambah nilai bulan
        -->
        
        <div class="header">
            <a href="?bulan=<?php echo $bulan-1; ?>&tahun=<?php echo $tahun; ?>">
            &lt;&lt; Bulan Sebelumnya
            </a>

            <h3><?php echo $nama_bulan[$bulan-1]." ".$tahun; ?></h3>
    
            <a href="?bulan=<?php echo $bulan+1; ?>&tahun=<?php echo $tahun; ?>">
            >> Bulan Berikutnya
            </a>
        </div>

        <!-- BAGIAN 8: TABEL KALENDER -->
            <table border="1">
        <!-- Baris header nama hari -->
            <tr>
                <th>Minggu</th><th>Senin</th><th>Selasa</th><th>Rabu</th>
                <th>Kamis</th><th>Jum'at</th><th>Sabtu</th>
            </tr>
    
        <tr>
            <?php
            /* 
             * BAGIAN 9: MENGISI SEL KOSONG SEBELUM TANGGAL 1
             * - Loop untuk mengisi sel kosong di awal kalender
             * - Jumlah sel kosong = hari pertama bulan tersebut
            */
            for ($i = 0; $i < $hari_pertama; $i++) {
                echo "<td style='border: 1px solid #333;'></td>"; // Sel kosong
            }
        
            /* 
             * BAGIAN 10: MENAMPILKAN SEMUA HARI DALAM BULAN
             * - Loop dari tanggal 1 sampai jumlah hari dalam bulan
             * - Setiap tanggal ditampilkan dalam sel tabel
            */
            for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
            // Jika hari ini sama dengan tanggal yang sedang diproses
            // DAN bulan dan tahun juga sama dengan saat ini
            if ($hari == date('j') && $bulan == date('n') && $tahun == date('Y')) {
                echo "<td style='color: white; background-color: red; font-weight: bold;'>$hari</td>"; // Tandai dengan tebal
            }
            // Jika hari ini sama dengan tanggal yang sedang diproses
            // tetapi bulan dan tahun berbeda
            else if ($hari == date('j')) {
                echo "<td style='color: white; background-color: red; font-weight: bold;'>$hari</td>"; // Tandai dengan merah dan tebal
            } 
             else {
                echo "<td style='border: 1px solid #333;'>$hari</td>"; // Tampilkan normal
            }
            
            /* 
             * BAGIAN 11: PINDAH BARIS SETIAP AKHIR MINGGU
             * - Jika (tanggal + hari pertama) habis dibagi 7
             * - Artinya sudah sampai hari Sabtu (akhir minggu)
             */
            if (($hari + $hari_pertama) % 7 == 0) {
                echo "</tr><tr>"; // Tutup baris, buka baris baru
            }
            }
            // Mengisi sel kosong setelah tanggal terakhir
            for ($i = ($jumlah_hari + $hari_pertama); $i % 7 != 0; $i++) {
                echo "<td style='border: 1px solid #333;'></td>"; // Sel kosong dengan border
            }
            ?>
        </tr>
        </table>
    
    </div>

    <canvas width="700" height="450" id="kanvas"></canvas>
    
</body>
</html>