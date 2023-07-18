<?php include_once('header.php') ?>
<main>
<?php
$stmt = $baseSpotisma->query('SELECT * FROM songs');
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);


include_once('carousel.php');
?>

</main>


</body>
</html>