<?php
    include('../config/connection.php');

    $data = json_decode(file_get_contents('php://input'), true);
    $search = $data;

    $stmt = $baseSpotisma->query('SELECT * FROM albums 
                                JOIN songs ON albums.id = songs.id_album
                                WHERE nameSong LIKE "%'. $search . '%" 
                                OR nameAlbum LIKE "%'. $search . '%"
                                OR artist LIKE "%'. $search . '%"');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $jsonAnswer = json_encode($results);

    echo $jsonAnswer;
?>