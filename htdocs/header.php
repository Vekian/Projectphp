<?php require_once('config/connection.php'); ?>
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
        <li class="nav-item offset-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                S'inscrire
            </button>
        </li>
        <li class="nav-item ml-5">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLog">
                Se connecter
            </button>
        </li>
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
                        <form action="signIn.php" method="POST">
                            <label for="name">Pseudo</label>
                            <input type="text" name="name" id="name">
                            <input type="submit" class="btn btn-primary" value="envoyer">
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
        <div class="modal fade" id="modalLog" tabindex="-1" role="dialog" aria-labelledby="modalLog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Se connecter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="logIn.php" method="POST">
                            <label for="name">Pseudo</label>
                            <input type="text" name="name" id="name">
                            <input type="submit" class="btn btn-primary" value="envoyer">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>