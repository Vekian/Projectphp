<?php
session_start();
    if(!isset($_SESSION['LOGGED_USER'])) {
        echo('Veuillez vous connecter pour écrire un commentaire');
    }
    else {
       echo(' <form action="process-comment.php" method="POST" >
       <label for="comment">Un ptit com\' ?</label>
        <input type="text" name="comment" id="comment"><br />
        <input type="hidden" name="id" id="id" value="' . $_SESSION['LOGGED_USER'] . '">
        <input type="submit" value="envoyer" id="submit">
       </form>
       ');
    };
?>
<script>
    let submit = document.getElementById('submit');

    submit.addEventListener('click', function(e) {
        e.preventDefault();
        let comment = document.getElementById('comment').value;
        let id = document.getElementById('id').value;
        let objet = {
            'name' : comment,
            'id' : id,
            'idSong' : songId
        };
        console.log(objet);
        });
        fetch('process-comment.php', {
            method: "POST",
            body: JSON.stringify(idQuizz)
            }
    )
</script>