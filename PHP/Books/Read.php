<?php

require '../../Database/MongodbDatabase.php';

$db = new MongodbDatabase;
$isbn = $_GET['isbn'];
$publisher = $db->getDataBookByISBN($isbn);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../CSS/BooksDetail.css">
    <link rel="stylesheet" href="../../CSS/Navigation.css">
    <link rel="stylesheet" href="../Font/fonts.css">

    <title> <?php $publisher[0]->buku[0]->judul ?> </title>
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

    <div class="container">
        <h1 class="text-white"><?= $publisher[0]->buku[0]->judul ?></h1>
        <iframe src="data:application/pdf;base64,<?= base64_encode($publisher[0]->buku[0]->pdf->getData()) ?>" width="100%" height="500px">
        </iframe>
    </div>

</body>