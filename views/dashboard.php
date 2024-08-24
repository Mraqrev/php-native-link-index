<?php
include __DIR__ . '/../config.php'; // Sesuaikan path jika perlu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $link_name = $_POST['link_name'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    
    // Query untuk menambahkan atau memperbarui post
    $stmt = $conn->prepare('INSERT INTO posts (title, link_name, slug) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE title = VALUES(title), link_name = VALUES(link_name), slug = VALUES(slug)');
    $stmt->bind_param('sss', $title, $link_name, $slug);
    $stmt->execute();

    // Simpan link download
    $post_id = $conn->insert_id;
    foreach ($_POST['download_link'] as $index => $download_link) {
        $provider = $_POST['provider'][$index];
        $color = $_POST['button_colors'][$index];
        $stmt = $conn->prepare('INSERT INTO download_links (post_id, provider, download_url, color) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('isss', $post_id, $provider, $download_link, $color);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="url"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="link_name">Link Name:</label>
        <input type="text" name="link_name" required>
        <br>
        <div id="download-links">
            <div class="download-link-group">
                <label for="provider[]">Provider:</label>
                <input type="text" name="provider[]" required>
                <br>
                <label for="download_link[]">Link Download:</label>
                <input type="text" name="download_link[]" required>
                <br>
                <label for="button_colors[]">Warna Button:</label>
                <select name="button_colors[]">
                    <option value="btn-blue">Biru</option>
                    <option value="btn-green">Hijau</option>
                    <option value="btn-red">Merah</option>
                    <option value="btn-yellow">Kuning</option>
                </select>
                <br><br>
            </div>
        </div>
        <button type="button" onclick="addLink()">Tambah Link</button>
        <button type="submit">Simpan</button>
    </form>
    <script>
        function addLink() {
            const section = document.getElementById('download-links');
            const group = document.createElement('div');
            group.className = 'download-link-group';
            group.innerHTML = `
                <label for="provider[]">Provider:</label>
                <input type="text" name="provider[]" required>
                <br>
                <label for="download_link[]">Link Download:</label>
                <input type="text" name="download_link[]" required>
                <br>
                <label for="button_colors[]">Warna Button:</label>
                <select name="button_colors[]">
                    <option value="btn-blue">Biru</option>
                    <option value="btn-green">Hijau</option>
                    <option value="btn-red">Merah</option>
                    <option value="btn-yellow">Kuning</option>
                </select>
                <br><br>
            `;
            section.appendChild(group);
        }
    </script>
</body>
</html>
