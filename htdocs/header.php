<?php 
session_start();
require_once('config/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotisma</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <ul class="nav row">
        <li class="nav-item offset-1">
            <a class="nav-link active" href="index.php">Accueil</a>
        </li>
        <li class="nav-item offset-1">
            <form action="index.php" method="POST">
                <input type="text" name="search" id="search" placeholder="tapez une chanson ou un artiste" >
                <input type="submit" value="rechercher" > 
            </form>
        </li>
        <li class="nav-item offset-1">
            <h4> Spot'Isma </h4>
        </li>
        <?php 
            if (!isset($_SESSION['LOGGED_USER'])) {
                echo ('<li class="nav-item offset-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Login
                </button>
                </li>');
            }
            else {
                echo ('<li class="nav_item offset-2" ><h4>Vous êtes connectés en tant que ' . $_SESSION['LOGGED_USER'] . '  <a href="process/logout.php">Se déconnecter</a></h4></li>');
            }
        ?>
    </ul>

<!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">S'inscrire</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
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