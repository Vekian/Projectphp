<?php 
session_start();
require_once('config/connection.php'); ?>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Spot'Isma</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav">
        <li class="nav-item">
            <form class="d-flex my-2 my-lg-0" action="#" method="POST">
                <input class="mr-sm-2 bg-secondary text-light" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning me-4" type="submit">Rechercher</button>
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
                <a class="nav-link dropdown-toggle me-auto" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ' . $_SESSION['LOGGED_USER'] . '
                </a>
                <ul class="dropdown-menu dropdown-menu-dark bg-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item text-light" href="admin.php">Ajouter une musique</a></li>
                    <li><a class="dropdown-item text-light" href="process/logout.php">Se déconnecter</a></h4></li></li>
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
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script> 
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