<?php
// Récupération des données des chansons depuis la base de données
$stmt = $baseSpotisma->query('SELECT * FROM songs');
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row col-12">
<div class="container-fluid col-9">
    <div class="row">
            <div id="songCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="carousel-content">
                    <?php $totalSongs = count($songs); ?>
                    <?php for ($i = 0; $i < $totalSongs; $i += 3) : ?>
                        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                            <div class="row">
                                <?php for ($j = $i; $j < min($i + 3, $totalSongs); $j++) : ?>
                                    <?php $song = $songs[$j]; ?>
                                    <div class="col-md-4">
                                        <div class="card" data-id="<?php echo $song['id']; ?>">
                                            <img src="<?php echo $song['cover']; ?>" class="card-img-top" alt="Cover">
                                            <div class="card-body d-flex flex-column text-center justify-content-center">
                                                <h5 class="card-title "><?php echo $song['nameSong']; ?></h5>
                                                <p class="card-text mb-xxl-5 mb-2"><?php echo $song['artist']; ?></p>
                                                <div id="buttonOfCard" >
                                                    <button type="button" class="btn btn-outline-warning btn-dark buttonAddPlaylist col-5" data-bs-toggle="modal" data-bs-target="#addPlaylistModal" value="inputToAddPlaylist">
                                                    <i class="fa-solid fa-plus" id="playlistAdd"></i> Playlist
                                                    </button>
                                                    <button type="button" class="btn btn-outline-warning btn-dark buttonAddToList col-5" value="inputToAddPlaylist">
                                                    <i class="fa-solid fa-plus" id="playlistAdd"></i> Lecture
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
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
                displayComment.innerHTML = '<button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">Un ptit com\' ?</button></div>';
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
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="process/insertSongPlaylist.php" method="POST">
                    <label for="namePlaylist">Choisissez votre playlist</label>
                    <select id="namePlaylist" name="namePlaylist">
                    <?php
                        foreach($playlistsData as $playlistData) {
                            echo('<option value="'. $playlistData['id'] . '"> ' . $playlistData["name"] .'</option>');
                        }
                    ?>
                    </select>
                    <input type="hidden" name="idSong" id="idSongInput" value="">
                    <input type="hidden" name="idUser" value="<?php echo($idUser) ?>">
                    <input type="submit" value="envoyer">
                </form>
            </div>
        </div>
    </div>
</div>