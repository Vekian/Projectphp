function toggleSongs(playlistId) {
    var playlistSongs = document.getElementById('playlist-songs-' + playlistId);
    if (playlistSongs.style.display === 'none') {
      playlistSongs.style.display = 'block';
    } else {
      playlistSongs.style.display = 'none';
    }
  }