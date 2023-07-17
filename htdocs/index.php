<?php include_once('header.php') ?>
<main>
<?php
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
                    <audio controls class="audioBar">
                        <source src="<?php echo $file; ?>" type="audio/mpeg">
                        Votre navigateur ne prend pas en charge la balise audio.
                    </audio>
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
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>