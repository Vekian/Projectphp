<?php
// Récupération des données des chansons depuis la base de données
$stmt = $baseSpotisma->query('SELECT * FROM albums 
                                JOIN songs ON albums.id = songs.id_album');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $jsonAnswer = json_encode($results);

echo '<script> var songs = ' . $jsonAnswer . '; </script>'
?>

<div class="row col-12">
<div class="container-fluid col-md-9 col-12 mainElement">
    <div class="row">
            <div id="songCarousel" class="carousel slide mx-auto" data-bs-ride="carousel">
                <div class="carousel-inner" id="carousel-content">
                    
                </div>
                <a class="carousel-control-prev" href="#songCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#songCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>



<script>
    <?php require_once("js/search.js");?>
    window.addEventListener("resize", function() {
        location.reload();
        height = window.innerHeight;
        playlistBlock = document.getElementsByClassName("playlist-block");
        playlistBlock[0].style.height = (height - 50) + "px";
    });
    generateCarouselContent(songs);
    let songId = "";
    document.addEventListener("DOMContentLoaded", function() {
        let cards = document.querySelectorAll(".card");
        cards.forEach(function(card) {
            card.addEventListener("click", function(e) {
                songId = card.getAttribute("data-id");
                if (e.target.value === "inputToAddPlaylist") {
                    e.stopPropagation();
                    document.getElementById('idSongInput').value = songId;
                    if (e.target.classList.contains('buttonAddToList')) {
                        fetch('process/playMusic.php', {
                            method: "POST",
                            body: JSON.stringify(songId)
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
                            let objetSong = {
                            "song" : data.nameSong,
                            "album" : data.nameAlbum,
                            "artist" : data.artist,
                            "artwork" : data.cover,
                            "mp3" : data.file
                            }
                            playlist.push(objetSong);
                        })
                    }
                }
                else {
                playMusic(songId);
                getComments(songId);
                if ("<?php echo(!isset($_SESSION['LOGGED_USER']))?>" == true){
                    displayCom.innerHTML = "<div class='text-light'>Veuillez vous connecter pour écrire un commentaire</div>";
                }
                else {
                displayComment.innerHTML = '<button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">Un ptit com\' ?</button></div>';
                };
            }});
        });
    });
    
</script>

<?php
    if(isset($_SESSION['LOGGED_USER'])) {
    $nameUser = $_SESSION['LOGGED_USER'];
    $stmt = $baseSpotisma->query('SELECT id FROM users WHERE name = "' . $nameUser . '"');
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $idUser =  $user['id'];

    $stmtPlaylists = $baseSpotisma->query('SELECT * FROM playlists WHERE id_user = "' . $idUser . '"');
    $playlistsData = $stmtPlaylists->fetchAll(PDO::FETCH_ASSOC);}
?>

<div class="modal fade" id="addPlaylistModal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPlaylistModalLabel">Ajouter à une playlist</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="process/insertSongPlaylist.php" method="POST" class="text-center">
                    <label for="namePlaylist">Choisissez votre playlist </label>
                    <select id="namePlaylist" class="bg-dark text-light" name="namePlaylist">
                    <?php
                        foreach($playlistsData as $playlistData) {
                            echo('<option value="'. $playlistData['id'] . '"> ' . $playlistData["name"] .'</option>');
                        }
                    ?>
                    </select>
                    <input type="hidden" name="idSong" id="idSongInput" value="">
                    <input type="hidden" name="idUser" value="<?php echo($idUser) ?>">
                    <input type="submit" class="btn btn-outline-warning btn-dark" value="envoyer">
                </form>
            </div>
        </div>
    </div>
</div>