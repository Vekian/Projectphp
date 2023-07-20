<?php
include ('../config/connection.php');

$data = json_decode(file_get_contents('php://input'), true);
$answer = "";
if (isset($data)) {
    $content = $data['content'];
    $nameUser = $data['id'];
    $idSong = $data['idSong'];

    $stmt = $baseSpotisma->query('SELECT id FROM users WHERE name = "' . $nameUser . '"');
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $idUser =  $user['id'];

$insertComment = $baseSpotisma -> prepare ('INSERT INTO comments(content, id_user, id_song) VALUES (:content, :id_user, :id_song)');
$insertComment -> execute([
        'content' => $content,
        'id_user' => $idUser,
        'id_song' => $idSong
    ]);
    
    $answer = ('Merci pour le commentaire !');
}
else {
    $answer = ("Ce commentaire est invalide");
}
echo (json_encode($answer));
?>