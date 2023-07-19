<?php
// Récupération des données des chansons depuis la base de données
$stmt = $baseSpotisma->query('SELECT * FROM songs');
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="songCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $totalSongs = count($songs); ?>
        <?php for ($i = 0; $i < $totalSongs; $i += 3) : ?>
            <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                <div class="row">
                    <?php for ($j = $i; $j < min($i + 3, $totalSongs); $j++) : ?>
                        <?php $song = $songs[$j]; ?>
                        <div class="col-md-4">
                            <div class="card" data-id="<?php echo $song['id']; ?>">
                                <img src="<?php echo $song['cover']; ?>" class="card-img-top" alt="Cover">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $song['name']; ?></h5>
                                    <p class="card-text"><?php echo $song['artist']; ?></p>
                                    <audio controls>
                                        <source src="<?php echo $song['file']; ?>" type="audio/mpeg">
                                        Votre navigateur ne prend pas en charge la balise audio.
                                    </audio>
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cards = document.querySelectorAll(".card");
        cards.forEach(function(card) {
            card.addEventListener("click", function() {
                let songId = card.getAttribute("data-id");
                // Utilisez la variable songId comme vous le souhaitez pour une utilisation ultérieure
                console.log("ID de la chanson sélectionnée : " + songId);
            });
        });
    });
</script>
