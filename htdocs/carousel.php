<?php
// Récupération des données des chansons depuis la base de données
$stmt = $baseSpotisma->query('SELECT * FROM songs');
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="songCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($songs as $index => $song) : ?>
            <?php
            $name = $song['name'];
            $artist = $song['artist'];
            $cover = $song['cover'];
            $file = $song['file'];
            $activeClass = $index === 0 ? 'active' : '';
            ?>

            <div class="carousel-item <?php echo $activeClass; ?>">
                <div class="carousel-content">
                    <h3><?php echo $name; ?></h3>
                    <p><?php echo $artist; ?></p>
                    <img src="<?php echo $cover; ?>" alt="Cover" class="cover-image">
        <br>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#songCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#songCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>
?>
