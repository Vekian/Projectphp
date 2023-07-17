<?php
session_start();
include('../config/connection.php');

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
    $name = $data['name'];
    $query = 'SELECT * from users where name = "' . $name . '"';
    $userStatement = $baseSpotisma -> prepare ($query);
    $userStatement -> execute();
    $user =$userStatement -> fetch(PDO::FETCH_ASSOC);

    $answer = [];
    if (empty($user)) {
        $insertStatement = $baseSpotisma -> prepare("INSERT INTO users (name, admin) VALUES (:name, :admin)");
        $insertStatement -> execute([
            'name' => $name,
            'admin' => 0
        ]);
        $_SESSION['LOGGED_USER'] = $name;
        $answer['name'] = 'Votre compte a bien été créé';
    }
    else {
        $_SESSION['LOGGED_USER'] = $name;
        $answer['name'] = "Vous êtes connectés !";
    }
}
else {
    $answer['name'] = "Veuillez renseigner un pseudo valide";
}
$jsonAnswer = json_encode($answer);
echo $jsonAnswer;
?>