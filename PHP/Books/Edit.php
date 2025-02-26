<?php
require '../../Database/MongodbDatabase.php';

$db = new MongodbDatabase;
$isbn = $_GET['isbn'];
$publisher = $db->getDataBookByISBN($isbn);
$category = $db->getCategory();
$collection = $db->fetchDataPublisher();

if (!empty($_POST['judul'])) {
    $result = $db->updateBook([
        'isbn' => $isbn,
        'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskripsi'],
        'penulis1' => $_POST['penulis1'],
        'translator' => $_POST['translator'],
        'tbl' => $_POST['tbl'],
        'kategori' => $_POST['kategori']
    ]);
    header("Location: ListofBooks.php");
}

$isbn = $publisher[0]->buku[0]->isbn;
$judul = $publisher[0]->buku[0]->judul;
$tebalBuku = $publisher[0]->buku[0]->tebal_buku;
$penerbit = $publisher[0]->nama;
$kategori = $publisher[0]->buku[0]->kategori;
$deskripsi = "";
$alih_bahasa = "";
if (isset($publisher[0]->buku[0]->deskripsi)) {
    $deskripsi = $publisher[0]->buku[0]->deskripsi;
}
if (isset($publisher[0]->buku[0]->alih_bahasa)) {
    $alih_bahasa = $publisher[0]->buku[0]->alih_bahasa;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../CSS/ListofBooks.css">
    <link rel="stylesheet" href="../Font/fonts.css">

    <title>Edit Buku</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="logo">
                <a href="../Intro.php" title="Back to main menu">
                    <p>Perpustakaan<br>Mantap</p>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="ListofBooks.php">Buku</a>
                    <a class="nav-item nav-link" href="../Visitors/Visitors.php">Pengunjung</a>
                    <a class="nav-item nav-link" href="../Borrowers/Borrowers.php">Pinjaman</a>
                    <a class="nav-item nav-link" href="../Publishers/Publishers.php">Penerbit</a>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <form name="formCreate" action="Edit.php?isbn=<?= $isbn ?>" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ISBN">ISBN*</label>
                        <input type="text" class="form-control" id="ISBN" name="isbn" disabled value="<?= $isbn; ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Judul">Judul*</label>
                        <input type="text" class="form-control" id="Judul" name="judul" value="<?= $judul; ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="Deskripsi" name="deskripsi"><?= $deskripsi; ?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Translator">Alih Bahasa</label>
                        <input type="text" class="form-control" id="Translator" name="translator" value=<?= $alih_bahasa; ?>>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Tbl">Tebal Buku*</label>
                        <input type="number" class="form-control" id="Tbl" name="tbl" value="<?= $tebalBuku; ?>" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="Kategori">Kategori*</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $kategori; ?>" required>
                    </div>
                    <?php $i = 1;
                    foreach ($publisher[0]->buku[0]->penulis as $writer) : ?>
                        <div class="col-md-4 mb-3">
                            <label for="Penulis<?= $i; ?> "><?php if ($i == 1) {
                                                                echo "Penulis 1*";
                                                            } else {
                                                                echo "Penulis " . $i;
                                                            } ?></label>
                            <input type="text" class="form-control" id="Penulis<?= $i; ?>" name="penulis<?= $i; ?>" value="<?= $writer ?>" <?php if ($i == 1) {
                                                                                                                                                echo "required";
                                                                                                                                            } ?>>
                        </div>
                    <?php $i++;
                    endforeach; ?>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>

            </form>

        </div>
    </section>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body>

</html>