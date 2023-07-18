<?php 
session_start();
require_once('config/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotisma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/player.css">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <?php 
            if (!isset($_SESSION['LOGGED_USER'])) {
                echo ('<li class="nav-item offset-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Login
                </button>
            </li>');
            }
            else {
                echo ('<li class="nav_item offset-2" ><h4>Vous êtes connectés en tant que ' . $_SESSION['LOGGED_USER'] . '  <a href="process/logout.php">Se déconnecter</a></h4></li>');
            }
        ?>
      </ul>
    </div>
  </div>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">S'inscrire</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="process/signIn.php" method="POST" id="formSign">
                <label for="name">Pseudo</label>
                <input type="text" name="name" id="name">
                <input type="submit" id="submit" class="btn btn-primary" value="envoyer">
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
<!-- Modal -->
    </header>