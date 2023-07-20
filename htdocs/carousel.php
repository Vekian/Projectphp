<?php
// Récupération des données des chansons depuis la base de données
$stmt = $baseSpotisma->query('SELECT * FROM songs');
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="songCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" id="carousel-content">
        <?php $totalSongs = count($songs); ?>
        <?php for ($i = 0; $i < $totalSongs; $i += 3) : ?>
            <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                <div class="row col-10 offset-1">
                    <?php for ($j = $i; $j < min($i + 3, $totalSongs); $j++) : ?>
                        <?php $song = $songs[$j]; ?>
                        <div class="col-md-4">
                            <div class="card" data-id="<?php echo $song['id']; ?>">
                                <img src="<?php echo $song['cover']; ?>" class="card-img-top" alt="Cover">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $song['nameSong']; ?></h5>
                                    <p class="card-text"><?php echo $song['artist']; ?></p>
                                    <button type="button" class="btn btn-outline-warning btn-dark buttonAddPlaylist" data-bs-toggle="modal" data-bs-target="#addPlaylistModal">
                                        Add to playlist
                                    </button>
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



<div class="modal fade" id="addPlaylistModal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPlaylistModalLabel">Ajouter à une playlist</h1>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Add to playlist.
            </div>
        </div>
    </div>
</div>

<script>
    let songId = "";
    document.addEventListener("DOMContentLoaded", function() {
        let cards = document.querySelectorAll(".card");
        cards.forEach(function(card) {
            card.addEventListener("click", function() {
                songId = card.getAttribute("data-id");
                playMusic(songId);
                getComments(songId);
                displayComment.innerHTML = '<button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">Un ptit com\' ?</button></div>';
            });
        });
    });
    let arrayOfButtonsPlaylist = document.getElementsByClassName('buttonAddPlaylist');
    for (let button of arrayOfButtonsPlaylist) {
		button.addEventListener("click", function(e) {
            e.stopPropagation();
		});}
    
</script>
