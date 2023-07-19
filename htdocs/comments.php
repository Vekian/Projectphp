<div id="sectionComments">
    <?php
    $idSong = 2;
    $stmt = $baseSpotisma->query('SELECT * FROM comments 
                                JOIN users ON comments.id_user = users.id
                                WHERE id_song = "' . $idSong . '"');
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    shuffle($comments);
    echo("<div id='comment' class='text-center border col-8 offset-2 rounded p-2'>");
    if (empty($comments)) {
        echo ("Il n'y a pas de commentaires sur cette chanson.");
    }
    else {
            echo("<p>" . $comments[0]['name'] . " a écrit : " . $comments[0]['content'] . "</p>");
    }
    ?>


    <?php
        if(!isset($_SESSION['LOGGED_USER'])) {
            echo('Veuillez vous connecter pour écrire un commentaire');
        }
        else {
        echo(' <button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">
        Un ptit com\' ?
    </button>
        ');
        };
        echo('</div>');
    ?>
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="commentModalLabel">Ecrivez un ptit commentaire</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="process-comment.php" method="POST" class="d-flex flex-column">
                <label for="commentInput" class="text-center">Un ptit com' ?</label>
                    <textarea name="commentInput" id="commentInput" class="bg-secondary"></textarea>
                    <input type="hidden" name="idComment" id="idComment" value="<?php echo($_SESSION['LOGGED_USER']) ?>">
                    <input type="submit" value="envoyer" id="submitComment" class="btn btn-outline-warning btn-dark">
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
    let submitComment = document.getElementById('submitComment');

    submitComment.addEventListener('click', function(e) {
        e.preventDefault();
        let comment = document.getElementById('commentInput').value;
        let id = document.getElementById('idComment').value;
        let songId = "2";
        let objet = {
            'content' : comment,
            'id' : id,
            'idSong' : songId
        };
        fetch('process/process-comment.php', {
            method: "POST",
            body: JSON.stringify(objet)
            })
        });
</script>