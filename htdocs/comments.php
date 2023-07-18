<?php
    if(!isset($_SESSION['LOGGED_USER'])) {
        echo('Veuillez vous connecter pour écrire un commentaire');
    }
    else {
       echo(' <form action="process-comment.php" method="POST" >
       <label for="comment">Un ptit com\' ?</label>
        <input type="text" name="comment" id="comment"><br />
        <input type="submit" value="envoyer">
       </form>
       ');
    }
?>