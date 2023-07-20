<div id="sectionComments">
    <div id="displayComments">
    </div>
    <div id="displayPostComments">
    </div>
    <div class="modal fade" id="listCommentModal" tabindex="-1" aria-labelledby="listCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="listCommentModalLabel">Tous les commentaires</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="listeOfComments">
                    
                </div>
            </div>
        </div>
    </div>




    <script>
        let displayComment = document.getElementById('displayPostComments');
        if ("<?php echo(!isset($_SESSION['LOGGED_USER']))?>" == true){
            displayComment.innerHTML = "Veuillez vous connecter pour écrire un commentaire";
        }
        else if (songId == "") {
            displayComment.innerHTML = "Veuillez choisir une chanson pour en voir les commentaires";
        }
        else{
            displayComment.innerHTML = '<button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">Un ptit com\' ?</button></div>';
        }
    </script>
    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="commentModalLabel">Ecrivez un ptit commentaire</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="process-comment.php" method="POST" class="d-flex flex-column" id="postComment">
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
        postComment();
        });
    

    function getComments(id) {
            fetch('process/readComment.php', {
		method: "POST",
		body: JSON.stringify(id)
		})
        .then(function(response) {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la requête AJAX');
        }
        })
        .then(function(data) {
            let sectionComments = document.getElementById('displayComments');
            if (data.length === 0) {
                sectionComments.innerHTML = "Il n'y a pas de commentaires sur cette chanson.";
            }
            else {
            document.getElementById("listeOfComments").innerHTML = "";
            for (let comment of data) {
                sectionComments.innerHTML = comment.name + " a écrit : " + comment.content + '  <button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#listCommentModal">Voir plus de commentaires</button>';
            document.getElementById("listeOfComments").innerHTML += comment.name + " a écrit : " + comment.content +"<br />";
            }}
        })
    }
    function postComment() {
        let comment = document.getElementById('commentInput').value;
        let id = document.getElementById('idComment').value;
        let objet = {
            'content' : comment,
            'id' : id,
            'idSong' : songId
        };
        fetch('process/process-comment.php', {
            method: "POST",
            body: JSON.stringify(objet)
            })
        .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de la requête AJAX');
                    }
                })
        .then(function(data) {
                document.getElementById("postComment").innerHTML = data;
                setTimeout(function() {
                    let myModalEl = document.getElementById('commentModal');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();
                }, 1000);
        });
    }
</script>