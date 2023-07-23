<?php 
session_start();
require_once('config/connection.php');
if(isset($_SESSION['LOGGED_USER'])) {
    $stmtAdmin = $baseSpotisma->query('SELECT admin FROM users WHERE name = "' . $_SESSION['LOGGED_USER'] . '"');
    $user = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
    $idAdmin =  $user['admin'];
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotisma</title>
    <link rel="stylesheet" href="css/playlist.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/player.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg " id="navColor">
  <div class="container">
    <a class="navbar-brand text-light" href="index.php">Spot'Isma<i class="fa-solid fa-headphones-simple" id="musicIcon"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">   
            <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
        </span>
    </button>
    <ul class="navbar-nav">
        <li class="nav-item">
            <form class="d-flex my-2 my-lg-0" action="#" method="POST">
                <input class="mr-sm-2 bg-secondary text-light" id="searchValue" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning me-4" id="searchInput" type="submit">Rechercher</button>
            </form>
        </li>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
        <?php 
            if (!isset($_SESSION['LOGGED_USER'])) {
                echo ('<li class="nav-item">
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Login
                </button>
            </li>');
            }
            else {
                echo('<li class="nav-item dropdown ml-5 " id="compte">
                <a class="nav-link dropdown-toggle text-light me-auto" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ' . $_SESSION['LOGGED_USER'] . '
                </a>
                <ul class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="navbarDarkDropdownMenuLink">');
                    if($idAdmin === 1) {
                        echo('<li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal" data-bs-target="#addSongModal">Ajouter une musique</a></li>');
                    };
                echo('<li><a class="dropdown-item text-light" href="process/logout.php">Se déconnecter</a></h4></li></li>
                </ul>
              </li>');
            }
        ?>
      </ul>
    </div>
  </div>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">S'inscrire</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="process/signIn.php" method="POST" id="formSign">
                <label for="name">Pseudo</label>
                <input type="text" name="name" id="name" class="bg-secondary">
                <input type="submit" id="submit" class="btn btn-outline-warning" value="envoyer">
            </form>
                <div id="answer">
                </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addSongModal" tabindex="-1" aria-labelledby="addSongModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light text-center">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addSongModalLabel">Ajouter une chanson</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="process/insertSong.php" enctype="multipart/form-data">
            <label for="nameAlbum">Nom de l'album</label>
            <input type="text" name="nameAlbum" id="nameAlbum" class="bg-secondary rounded">
            <label for="cover" class="custom-file-label">Votre image d'album</label>
            <input type="file" id="cover" name="cover" class="bg-secondary custom-file-input rounded mt-1"/>
            <label for="numberOfSongs" >Nombre de chansons</label>
            <input type="number" name="numberOfSongs" id="numberOfSongs" min="1" class="bg-secondary rounded mt-1">
            <div id="songsToAdd"></div>
            <br />
        </form>
        </div>
    </div>
  </div>
</div>
<script> 

    let numberSong= "";
    let elmSong = document.getElementById('numberOfSongs');
    elmSong.addEventListener('change', function (e) {
        document.getElementById('songsToAdd')
                .innerHTML = "";
        numberSong = e.target.value;
        for(let i = 1; i <= numberSong ; i++) {
            document.getElementById('songsToAdd')
                    .innerHTML += '<label for="nameSong'+ i +'">Nom de la chanson</label><input type="text" name="nameSong'+ i +'" id="nameSong'+ i +'" class="bg-secondary rounded mt-1"><label for="music'+ i +'">Votre musique</label><input type="file" id="music'+ i +'" name="music'+ i +'" class="bg-secondary rounded mt-1" /><label for="artist'+ i +'">Nom de l\'artiste</label><input type="text" name="artist'+ i +'" id="artist'+ i +'" class="bg-secondary rounded mt-1"><br />';
        }
        document.getElementById('songsToAdd')
                    .innerHTML += '<input type="submit" value="Envoyer" class="btn btn-outline-warning mt-1">';
    });
    let inputSubmit = document.getElementById('submit');

    inputSubmit.addEventListener('click', function(e) {
        e.preventDefault();
        let inputName = document.getElementById('name').value;
        let objet = {
            'name' : inputName
        }
        console.log(objet);
        fetch('process/signIn.php', {
                            method: "POST",
                            body: JSON.stringify(objet)
                            }
    )
        .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de la requête AJAX');
                    }
                })
        .then(function(data) {
            document.getElementById('formSign').innerHTML = "";
            document.getElementById('answer').innerHTML = data.name;
            setTimeout(function() {
                    window.location.reload();
                }, 1000);
            })
    });
</script>

    </header>