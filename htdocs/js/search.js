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
              generateCarouselContent(songs);
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

function createSongCard(song) {
    return `
      <div class="col-md-4">
        <div class="card" data-id="${song.id}">
          <img src="${song.cover}" class="card-img-top" alt="Cover">
          <div class="card-body d-flex flex-column text-center justify-content-center">
            <h5 class="card-title">${song.nameSong}</h5>
            <p class="card-text mb-xxl-5 mb-2">${song.artist}</p>
            <div id="buttonOfCard">
              <button type="button" class="btn btn-outline-warning btn-dark buttonAddPlaylist col-5" data-bs-toggle="modal" data-bs-target="#addPlaylistModal" value="inputToAddPlaylist">
                <i class="fa-solid fa-plus" id="playlistAdd"></i> Playlist
              </button>
              <button type="button" class="btn btn-outline-warning btn-dark buttonAddToList col-5" value="inputToAddPlaylist">
                <i class="fa-solid fa-plus" id="playlistAdd"></i> Lecture
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  // Function to generate the carousel content
  function generateCarouselContent(songs) {
    const carouselContent = document.getElementById("carousel-content");
    let totalSongs = songs.length;
    let html = "";
    let windowWidth = window.innerWidth;
    

    if (windowWidth < 768) {
      for (let i = 0; i < totalSongs; i += 1) {
        html += `<div class="carousel-item ${i === 0 ? 'active' : ''}"><div class="row">`;
  
        for (let j = i; j < Math.min(i + 1, totalSongs); j++) {
          html += createSongCard(songs[j]);
        }
  
        html += "</div></div>";
      }
    }
    else {
    for (let i = 0; i < totalSongs; i += 3) {
      html += `<div class="carousel-item ${i === 0 ? 'active' : ''}"><div class="row">`;

      for (let j = i; j < Math.min(i + 3, totalSongs); j++) {
        html += createSongCard(songs[j]);
      }

      html += "</div></div>";
    }}

    carouselContent.innerHTML = html;
  }