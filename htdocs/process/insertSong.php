<?php
include('../config/connection.php');
print_r($_POST);
if (isset($_FILES['cover']) AND $_FILES['cover']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
    if ($_FILES['cover']['size'] <= 3000000)
    {
            // Testons si l'extension est autorisée
            $fileInfo = pathinfo($_FILES['cover']['name']);
            $extension = $fileInfo['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            if (in_array($extension, $allowedExtensions))
            {
                move_uploaded_file($_FILES['cover']['tmp_name'], '../images/' . basename($_FILES['cover']['name']));
            }
    }
    $cover = '/images/' . basename($_FILES['cover']['name']);
    $nameAlbum = $_POST['nameAlbum'];
    $insertAlbum = $baseSpotisma -> prepare ('INSERT INTO albums(nameAlbum, cover) VALUES (:nameAlbum, :cover)');
    $insertAlbum -> execute([
        'nameAlbum' => $nameAlbum,
        'cover' => $cover
    ]);
    $stmt = $baseSpotisma->query('SELECT id FROM albums WHERE nameAlbum = "' . $nameAlbum . '"');
    $album = $stmt->fetch(PDO::FETCH_ASSOC);
    $album =  $album['id'];
    echo $album;
    $numberOfSongs = $_POST['numberOfSongs'];
    for($i = 1; $i <= $numberOfSongs; $i++) {

        // Testons si le fichier n'est pas trop gros
        if ($_FILES['music' . $i]['size'] <= 10000000)
        {
                // Testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['music' . $i]['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['mp3'];
                if (in_array($extension, $allowedExtensions))
                {
                    move_uploaded_file($_FILES['music'.$i]['tmp_name'], '../musics/' . basename($_FILES['music' . $i]['name']));
                }
        }
        
        $nameSong = $_POST['nameSong' . $i];
        $file = '/musics/' . basename($_FILES['music' . $i]['name']);
        $artist = $_POST['artist' . $i];
        echo $nameSong;
        echo $artist;
        echo $file;
        $insertSong = $baseSpotisma -> prepare ('INSERT INTO songs(nameSong, file, cover, artist, id_album) VALUES (:nameSong, :file, :cover, :artist, :id_album)');
        $insertSong -> execute([
        'nameSong' => $nameSong,
        'file' => $file,
        'cover' => $cover,
        'artist' => $artist,
        'id_album' => $album
    ]);
}}
