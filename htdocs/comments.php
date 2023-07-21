<div id="sectionComments" class="border col-md-5 offset-md-7 ps-2 col-12">
    <div class="row">
        <div id="displayComments">
        </div>
        <div id="displayPostComments" >
        </div>
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
        let displayCom = document.getElementById('displayComments');
        let displayComment = document.getElementById('displayPostComments');
        if ("<?php echo(!isset($_SESSION['LOGGED_USER']))?>" == true){
            displayCom.innerHTML = "<div class='text-light'>Veuillez vous connecter pour écrire un commentaire</div>";
        }
        else if (songId == "") {
            displayCom.innerHTML = "<div class='text-light'>Veuillez choisir une chanson pour en voir les commentaires</div>";
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
                sectionComments.innerHTML = "<div class='text-light'>Il n'y a pas de commentaires sur cette chanson.</div>";
            }
            else {
            document.getElementById("listeOfComments").innerHTML = "";
            displayComment.innerHTML += '<button type="button" class="btn btn-outline-warning btn-dark col-8" data-bs-toggle="modal" data-bs-target="#listCommentModal">Voir plus de commentaires</button>';
            for (let comment of data) {
                sectionComments.innerHTML = "<div class='col-12 text-light'>" + comment.name + " a écrit : " + comment.content + '  </div>';
                document.getElementById("listeOfComments").innerHTML += "<div class='border p-2'>" + comment.name + " a écrit : " + comment.content + "</div><br />";
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

<div class="col-md-3 col-12">
            <?php 
            include 'playlist.php';
            ?>
</div>
</div>