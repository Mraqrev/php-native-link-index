<?php
include __DIR__ . '/../config.php';// Sesuaikan path jika perlu

// Ambil daftar post dari database, urutkan berdasarkan slug secara ascending
$result = $conn->query('SELECT * FROM posts ORDER BY slug ASC');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Post - INDEX.NUHBIX.COM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1><a href="/" style="color: #fff; text-decoration: none;">INDEX.NUHBIX.COM - DOWNLOAD MOVIE HQ</a></h1>
    </header>

    <!-- Daftar Post -->
    <div class="container">
        <h1>Daftar Post</h1>
        <ul>
            <?php while ($post = $result->fetch_assoc()): ?>
                <li><a href="/post/<?= htmlspecialchars($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a></li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
