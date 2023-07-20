<?php
include('../config/connection.php');

$data = json_decode(file_get_contents('php://input'), true);
$idSong = $data;

$stmt = $baseSpotisma->query('SELECT name, content FROM comments 
                                JOIN users ON comments.id_user = users.id
                                WHERE id_song = "' . $idSong . '"');
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$jsonAnswer = json_encode($comments);
echo $jsonAnswer;
?>