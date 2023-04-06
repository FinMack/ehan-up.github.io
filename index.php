<!DOCTYPE html>
<html>
<head>
    <title>Form Upload Foto By ehan7 - zero cyber team</title>
    <style>
        /* CSS tema hitam */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #222;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        a {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Upload Foto</h1>
        <br><h4>By ehan7 - zero cyber team </h4>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="foto" accept="image/*">
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $foto = $_FILES['foto'];
        $folderName = generateRandomString(14); // Generate nama folder random
        $folderPath = "./" . $folderName; // Path folder
        mkdir($folderPath); // Membuat folder

        // Menyimpan file foto ke folder yang telah dibuat
        $targetPath = $folderPath . '/' . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], $targetPath);

        // Membuat file index.php dalam folder
        $indexFile = fopen($folderPath . '/index.php', "w");
        $indexCode = '<?php header("HTTP/1.0 403 Forbidden"); echo "403 Forbidden <> Mau Ngapain bro?"; ?>';
        fwrite($indexFile, $indexCode);
        fclose($indexFile);

        echo '<script>alert("Foto diupload ke folder ' . $folderName . '");</script>';
        echo '<p>File hasil upload: <a href="' . $folderName . '/' . basename($foto['name']) . '" target="_blank">' . basename($foto['name']) . '</a></p>';
    }

    // Fungsi untuk generate string random
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    ?>
</body>
</html>
