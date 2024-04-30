<?php
require_once 'DatabaseConnection.php';

class AnggotaCRUD
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnection::connect();
    }

    public function createAnggota($nama, $fraksi, $dapil)
    {
        $stmt = $this->connection->prepare("INSERT INTO nama_anggota (nama, fraksi, dapil) VALUES (:nama, :fraksi, :dapil)");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':fraksi', $fraksi);
        $stmt->bindParam(':dapil', $dapil);
        $stmt->execute();
    }

    public function displayAnggota()
{
    $stmt = $this->connection->prepare("SELECT * FROM nama_anggota");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h2>Daftar Anggota</h2>';
    echo '<a href="?action=add" class="btn btn-primary mb-3"><button type="submit" class="btn-submit">Tambah Anggota</button></a>';
    echo '<table class="table">';
    echo '<tr><th>ID</th><th>Nama</th><th>fraksi</th><th>Dapil</th><th>Edit</th><th>Hapus</th></tr>';

    foreach ($result as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nama'] . '</td>';
        echo '<td>' . $row['fraksi'] . '</td>';
        echo '<td>' . $row['dapil'] . '</td>';
        echo '<td><a href="?action=edit&id=' . $row['id'] . '"><i class="bi bi-pencil"></i></a></td>';
        echo '<td><a href="?action=delete&id=' . $row['id'] . '"><i class="bi bi-trash"></i></a></td>';
        echo '</tr>';
    }

    echo '</table>';
}

    public function getAnggotaById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM nama_anggota WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function displayEditForm($id)
    {
        $anggota = $this->getAnggotaById($id);
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="id" value="' . $anggota['id'] . '">';
        echo '<div class="form-group">
                  <label for="nama" class="form-label">Nama:</label>
                  <input type="text" id="nama" name="nama" class="form-control" value="' . $anggota['nama'] . '" required>
              </div>';
        echo '<div class="form-group">
                  <label for="fraksi" class="form-label">Fraksi:</label>
                  <input type="text" id="fraksi" name="fraksi" class="form-control" value="' . $anggota['fraksi'] . '" required>
              </div>';
        echo '<div class="form-group">
                  <label for="dapil" class="form-label">Dapil:</label>
                  <input type="text" id="dapil" name="dapil" class="form-control" value="' . $anggota['dapil'] . '" required>
              </div>';
        echo '<button type="submit" class="btn-submit">Update</button>';
        echo '</form>';
    }

    public function updateAnggota($id, $nama, $fraksi, $dapil)
    {
        $stmt = $this->connection->prepare("UPDATE nama_anggota SET nama = :nama, fraksi = :fraksi, dapil = :dapil WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':fraksi', $fraksi);
        $stmt->bindParam(':dapil', $dapil);
        $stmt->execute();
    }

    public function deleteAnggota($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM nama_anggota WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

$anggotaCRUD = new AnggotaCRUD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id'])) {
        $anggotaCRUD->updateAnggota($_POST['id'], $_POST['nama'], $_POST['fraksi'], $_POST['dapil']);
        echo "Data anggota berhasil diperbarui!";
    } else {
        $anggotaCRUD->createAnggota($_POST['nama'], $_POST['fraksi'], $_POST['dapil']);
        echo "Anggota telah berhasil ditambahkan!";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $anggotaCRUD->deleteAnggota($_GET['id']);
    echo "Anggota dengan ID " . $_GET['id'] . " telah berhasil dihapus!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota DPR</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <?php
        
        $anggotaCRUD = new AnggotaCRUD();

        
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            echo '<h2>Edit Anggota</h2>';
            $anggotaCRUD->displayEditForm($_GET['id']);
        } else {
            echo '<h2>Tambah Anggota Baru</h2>'; 
            
            echo '<form action="" method="POST">';
            echo '<div class="form-group">';
            echo '<label for="nama" class="form-label">Nama:</label>';
            echo '<input type="text" id="nama" name="nama" class="form-control" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="fraksi" class="form-label">Fraksi:</label>';
            echo '<input type="text" id="fraksi" name="fraksi" class="form-control" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="dapil" class="form-label">Dapil:</label>';
            echo '<input type="text" id="dapil" name="dapil" class="form-control" required>';
            echo '</div>';
            echo '<button type="submit" class="btn-submit">Submit</button>';
            echo '</form>';
        }
        ?>
        
        <?php
        $anggotaCRUD->displayAnggota();
        ?>
    </div>
</body>
</html>
