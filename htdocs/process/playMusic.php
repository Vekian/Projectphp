<?php
include('../config/connection.php');

$data = json_decode(file_get_contents('php://input'), true);

$id = $data;

$stmt = $baseSpotisma->query('SELECT * FROM songs 
                        JOIN albums ON songs.id_album = albums.id
                        WHERE songs.id = "' . $id . '"');
    $song = $stmt->fetch(PDO::FETCH_ASSOC);
    $jsonAnswer = json_encode($song);
    
    echo $jsonAnswer;
?>