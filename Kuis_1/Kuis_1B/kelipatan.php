<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelipatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            min-height: 90vh;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        #kanvas {
            background-color: #f0f0f0;
            justify-content: center;
            align-items: center;
            display: flex;
            margin-top: 60px;
            position: relative;
        }

        .container {
            width: 650px;
            top: 110%;
            left: 50%;
            padding-top: 50px;
            padding: 10px;
            /* text-align: center; */
            position: absolute;
            display: flex;
            transform: translate(-50%, -50%);
            flex-direction: column;
            /* align-items: center; */
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .highlight {
            background-color:rgb(139, 210, 142); /* Warna latar belakang untuk kelipatan */
        }

        #kelipatan {
            width: 25%;
        }
    </style>

</head>

<body>

    <div class="container">
        <?php $kelipatan = $_POST['kelipatan'] ?? 0; ?>

        <form method="get">
            Masukkan Kelipatan: <input type="number" id="kelipatan" name="kelipatan" min="1" max="10" required>
            <input type="submit" value="Kirim">
        </form>

       <?php
        // Mengambil input kelipatan dari pengguna
        $kelipatan = isset($_GET['kelipatan']) ? intval($_GET['kelipatan']) : 1;

        // Validasi input
        if ($kelipatan < 1 || $kelipatan > 10) {
            echo "<p class='error'>Silakan masukkan angka kelipatan antara 1 dan 10.</p>";
        } else {
            // Tampilkan header kelipatan
            echo "<h1>Kelipatan dari $kelipatan</h1>";
            // Tampilkan tabel
            echo "<table>";
            echo "<tr><th>Angka</th><th>Kelipatan</th></tr>";
            for ($angka = 1; $angka <= 40; $angka++) {
                if ($angka % $kelipatan == 0) {
                    echo "<tr><td>$angka</td><td class='highlight'>$angka (kelipatan dari $kelipatan)</td></tr>";
                } else {
                    echo "<tr><td>$angka</td><td>$angka</td></tr>";
                }
            }
            echo "</table>";
        }
        ?>        

    </div>
    
    <canvas width="700" height="1580" id="kanvas"></canvas>

</body>
</html>

