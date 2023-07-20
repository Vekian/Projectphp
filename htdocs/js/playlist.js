function toggleSongs(playlistId) {
    let playlistSongs = document.getElementById('playlist-songs-' + playlistId);
    if (playlistSongs.style.display === 'none') {
      playlistSongs.style.display = 'block';
    } else {
      playlistSongs.style.display = 'none';
    }
  }