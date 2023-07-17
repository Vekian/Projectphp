<?php require_once('config/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotisma</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <header class="d-flex">
        <a href="index.php">Accueil</a>
        <form action="index.php" method="POST">
            <input type="text" name="search" id="search" placeholder="tapez une chanson ou un artiste" >
            <input type="submit" value="rechercher" > 
        </form>
    
        <div class="text-center">
            <button class="btn btn-danger btn-lg btn-light-hover text-danger-hover" type="button" data-toggle="modal" data-target="#exampleModal">
                <strong>Learn more >></strong>
            </button>
        </div> 
          
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/pPwtvpBJWM0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                </div>
            </div>
        </div>
    </header>