<?php
    include('../config/connection.php');
$nameUser = "mathieu";

$stmt = $baseSpotisma->query('SELECT id FROM users WHERE name = "' . $nameUser . '"');
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $idUser =  $user['id'];

$stmt = $baseSpotisma->query('SELECT * FROM playlists
                            WHERE playlists.id_user = "' . $idUser . '"');
$playlists = $stmt->fetchAll(PDO::FETCH_ASSOC);

$arrayPlaylist = [];
foreach ($playlists as $playlist) {
    $array = [];
    $idPlaylist = $playlist['id'];

    $stmt = $baseSpotisma->query('SELECT songs.nameSong FROM songs
                                JOIN playlist_songs ON songs.id = playlist_songs.id_song
                                JOIN playlists ON playlist_songs.id_playlist = playlists.id
                                WHERE playlists.id = "' . $idPlaylist . '"');
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $arraySongs= [];
    foreach($songs as $song) {
       array_push($arraySongs, $song['nameSong']); 
    }
    $array[$playlist['name']] = $arraySongs;
    array_push($arrayPlaylist, $array);
}

print_r($arrayPlaylist);
?>