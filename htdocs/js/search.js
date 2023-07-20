document.getElementById("searchInput")
        .addEventListener("click", function(e){
            e.preventDefault();
            search();
        });

function search() {
    let input = document.getElementById("searchValue").value;
    fetch('process/process-search.php', {
        method: "POST",
        body: JSON.stringify(input)
        }
)
    .then(function(response) {
    if (response.ok) {
        return response.json();
    } else {
        throw new Error('Erreur lors de la requête AJAX');
    }
    })
    .then(function(data) {
        console.log(data);
        let songs = data;
        if (songs.length === 0) {
            document.getElementById('carousel-content').innerHTML = "Aucune chanson ne correspond à cette recherche";
        }
        else{
        // Supprimer le contenu existant du conteneur "carousel-content"
    document.getElementById('carousel-content').innerHTML = "";

    // Supposons que vous ayez une variable "songs" qui contient les données des chansons comme dans PHP
    // Exemple : var songs = [{id: 1, cover: 'url_de_la_pochette', nameSong: 'Titre1', artist: 'Artiste1'}, {id: 2, cover: 'url_de_la_pochette', nameSong: 'Titre2', artist: 'Artiste2'}, ...];

    // Compter le nombre total de chansons
    var totalSongs = songs.length;

    // Parcourir les chansons en groupes de 3 pour créer les éléments HTML dynamiquement
    for (var i = 0; i < totalSongs; i += 3) {
        var carouselItem = document.createElement('div');
        carouselItem.className = "carousel-item" + (i === 0 ? " active" : "");

        var row = document.createElement('div');
        row.className = "row col-10 offset-1";

        // Boucler pour créer les éléments "col-md-4" et remplir avec les données des chansons
        for (var j = i; j < Math.min(i + 3, totalSongs); j++) {
            var song = songs[j];

            var colMd4 = document.createElement('div');
            colMd4.className = "col-md-4";

            var card = document.createElement('div');
            card.className = "card";
            card.setAttribute('data-id', song.id);

            var img = document.createElement('img');
            img.className = "card-img-top";
            img.src = song.cover;
            img.alt = "Cover";

            var cardBody = document.createElement('div');
            cardBody.className = "card-body";

            var cardTitle = document.createElement('h5');
            cardTitle.className = "card-title";
            cardTitle.textContent = song.nameSong;

            var cardText = document.createElement('p');
            cardText.className = "card-text";
            cardText.textContent = song.artist;

            var button = document.createElement('button');
            button.type = "button";
            button.className = "btn btn-outline-warning btn-dark buttonAddPlaylist";
            button.setAttribute('data-bs-toggle', 'modal');
            button.setAttribute('data-bs-target', '#addPlaylistModal');
            button.textContent = "Add to playlist";

            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardText);
            cardBody.appendChild(button);

            card.appendChild(img);
            card.appendChild(cardBody);

            colMd4.appendChild(card);
            row.appendChild(colMd4);
        }

        carouselItem.appendChild(row);

        // Ajouter le carouselItem au conteneur "carousel-content"
        document.getElementById('carousel-content').appendChild(carouselItem);
    }
        let cards = document.querySelectorAll(".card");
        cards.forEach(function(card) {
            card.addEventListener("click", function() {
                songId = card.getAttribute("data-id");
                playMusic(songId);
                getComments(songId);
                displayComment.innerHTML = '<button type="button" class="btn btn-outline-warning btn-dark col-4" data-bs-toggle="modal" data-bs-target="#commentModal">Un ptit com\' ?</button></div>';
            });
        });
    }});
}

