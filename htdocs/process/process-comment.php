<?php
include ('../config/connection.php');

$insertComment = $baseSpotisma -> prepare ('INSERT INTO comments(score, id_user, id_quizz) VALUES (:score, :id_user, :id_quizz)');
        $insertComment -> execute([
            'score' => $score,
            'id_user' => $iduser,
            'id_quizz' => $idQuizz
        ]);
?>