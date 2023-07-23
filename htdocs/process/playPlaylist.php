<?php
include('../config/connection.php');
$data = json_decode(file_get_contents('php://input'), true);
$idPlaylist = $data['id'];
$random = $data['random'];


$stmt = $baseSpotisma->query('SELECT * FROM songs
                                JOIN playlist_songs ON songs.id = playlist_songs.id_song
                                JOIN playlists ON playlist_songs.id_playlist = playlists.id
                                JOIN albums ON albums.id = songs.id_album
                                WHERE playlists.id = "' . $idPlaylist . '"');
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($random == true) {
        shuffle($songs);
    }
    $jsonAnswer = json_encode($songs);
    print_r($jsonAnswer);
?>