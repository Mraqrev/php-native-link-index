<?php
include __DIR__ . '/../config.php'; // Sesuaikan path jika perlu

$slug = $_GET['slug'] ?? '';
$stmt = $conn->prepare('SELECT * FROM posts WHERE slug = ?');
$stmt->bind_param('s', $slug);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    http_response_code(404);
    include '404.php'; // Halaman 404 jika post tidak ditemukan
    exit;
}

// Periksa 'link_name'
$link_name = isset($post['link_name']) ? htmlspecialchars($post['link_name']) : 'Nama Link Tidak Tersedia';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Download <?= htmlspecialchars($post['title']) ?> - Index.nuhbix.com</title>
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
        p {
            line-height: 1.6;
        }
        .highlight {
            background-color: #ffeb3b;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-blue { background-color: #007bff; }
        .btn-green { background-color: #28a745; }
        .btn-red { background-color: #dc3545; }
        .btn-yellow { background-color: #ffc107; }
        .btn-blue:hover { background-color: #0056b3; }
        .btn-green:hover { background-color: #218838; }
        .btn-red:hover { background-color: #c82333; }
        .btn-yellow:hover { background-color: #e0a800; }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1><a href="/" style="color: #fff; text-decoration: none;">INDEX.NUHBIX.COM - DOWNLOAD MOVIE HQ</a></h1>
    </header>

    <!-- Single Post -->
    <div class="container">
        <h1>Download <?= htmlspecialchars($post['title']) ?></h1>
        <p>Untuk mendownload film silahkan klik</p> <a href="<?= htmlspecialchars($post['link_name']) ?>"><?= htmlspecialchars($post['link_name']) ?></a>
        <p>Jika salah satu mirror tidak bisa mendownload atau error, maka silahkan pilih mirror lainnya.</p>
        <div class="highlight">Please consider. This Download URL Using Popup ADS.</div>
        
        <!-- Table of download links -->
        <table>
            <thead>
                <tr>
                    <th>Provider</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare('SELECT * FROM download_links WHERE post_id = ?');
                $stmt->bind_param('i', $post['id']);
                $stmt->execute();
                $links = $stmt->get_result();
                while ($link = $links->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($link['provider']) . '</td>';
                    echo '<td><a href="' . htmlspecialchars($link['download_url']) . '" class="btn ' . htmlspecialchars($link['color']) . '" target="_blank">Download</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
