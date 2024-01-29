@section('content')

<div class="container-fluid">
   <div class="mb-3">
      <p class="fw-normal fs-3 lh-sm"><strong>List of Songs</strong></p>
         <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Song Title</th>
                  <th scope="col">Artist</th>
                  <th scope="col">Duration</th>
                  <th scope="col">Genre</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
          @isset($songs)            
            <tbody>
               @foreach ($songs as $data)
                  <tr>
                     <th scope="row">{{$data->id}}</th>
                     <td>{{$data->song_title}}</td>
                     <td>{{$data->artist}}</td>
                     <td>{{$data->duration}}</td>
                     <td>{{$data->genre}}</td>
                     <td>
                        <div class="mt-0">
                           <button id="playButton" class="btn playButton" data-id={{$data->id}} data-bs-toggle="tooltip" 
                              data-bs-placement="top" title="{{$data->id}}.{{$data->song_title }}">Play</button>
                           <button id="pauseButton" class="btn pauseButton" data-id="{{$data->id}}">Pause</button>
                       </div>                      
                     </td>
                  </tr>
               @endforeach
            </tbody>
          @else
          <tbody>
               <tr>
                  <th scope="row" colspan="5"><p>No songs available.</p></th>
               </tr>
         </tbody>
         @endisset 
         </table>
   </div>
</div>

<div class="container-fluid">
   <div class="row justify-content-center align-items-center">
      <div class="col-md-6">
         <div class="mb-3 text-center">
               <label for="audioPlayerTitle" class="form-label ">Song Title - Artist</label>
               <p id="audioPlayerTitle" class="fw-bold fs-4"></p>
         </div>

         <div class="mb-3 text-center">
               <audio id="audioPlayer" controls></audio>
         </div>

         <div class="mb-3 text-center">
            <button id="stopButton" class="btn btn-secondary" title="pause">Pause</button>
            <button id="prevButton" class="btn btn-secondary" title="previous">Previous</button>
            <button id="nextButton" class="btn btn-secondary" title="next">Next</button>
            <button id="randomButton" class="btn btn-warning" title="random">Random</button>

         </div>
      </div>
   </div>
</div>


<script>
   const audioPlayer = document.getElementById('audioPlayer');
   const playButtons = document.querySelectorAll('.playButton');
   const pauseButtons = document.querySelectorAll('.pauseButton');
   const nextButton = document.getElementById('nextButton');
   const prevButton = document.getElementById('prevButton');
   const randomButton = document.getElementById('randomButton');
   const audioPlayerTitle = document.getElementById('audioPlayerTitle');
   const songs = {!! json_encode($songs) !!}; 

   let currentSongIndex = 0;
   let playbackPosition = 0; 
   let lastPlayedSongId = null;
   let playedSongs = [];

   playButtons.forEach(function (button) {
       new bootstrap.Tooltip(button);
       button.innerHTML = '<img src="/icons/file-play-fill.svg" alt="Play" style="width: 1.5em; height: 1.5em;">';
       button.addEventListener('click', function () {
           const songId = button.getAttribute('data-id');
           playSong(songId);
       });
   });

   pauseButtons.forEach(function (button) {
       new bootstrap.Tooltip(button);
       button.innerHTML = '<img src="/icons/pause-btn-fill.svg" alt="Puase" style="width: 1.5em; height: 1.5em;">';
       button.addEventListener('click', function () {
           pauseSong();
       });
   });

   stopButton.innerHTML = '<img src="/icons/pause-btn-fill.svg" alt="Stop">';
   nextButton.innerHTML = '<img src="/icons/arrow-right-square-fill.svg" alt="Next">';
   prevButton.innerHTML = '<img src="/icons/arrow-left-square-fill.svg" alt="Previous">';
   randomButton.innerHTML = '<img src="/icons/shuffle.svg" alt="Random">';
   
   function playSong(id) {
    fetch(`/music/play/${id}`)
        .then(response => response.json())
        .then(data => {
            audioPlayer.src = data.song_filename;

            audioPlayer.addEventListener('loadedmetadata', function () {
                audioPlayer.currentTime = playbackPosition;
                audioPlayer.play();
            });

            audioPlayerTitle.textContent = `${songs[currentSongIndex].song_title} - ${songs[currentSongIndex].artist}`;
        });

        audioPlayer.addEventListener('ended', function () {
            nextSong();
        });
   }

   function pauseSong() {
       playbackPosition = audioPlayer.currentTime;
       audioPlayer.pause();
   }

   function nextSong() {
       currentSongIndex = (currentSongIndex + 1) % songs.length;
       playSong(songs[currentSongIndex].id);
   }

   function prevSong() {
       currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
       playSong(songs[currentSongIndex].id);
   }

   // random play song using math.random
   // function playRandomSong() {
   //      const randomIndex = Math.floor(Math.random() * songs.length);
   //      currentSongIndex = randomIndex;
   //      playSong(songs[currentSongIndex].id);
   // }

   function playRandomSong() {
      fetch(`/music/random`)
         .then(response => response.json())
         .then(data => {
               const randomSongId = data.random_song_id;

               // Ensure the randomly selected song is different from the last played one
               // and has not been played before
               if (randomSongId !== lastPlayedSongId && !playedSongs.includes(randomSongId)) {
                  lastPlayedSongId = randomSongId;
                  playedSongs.push(randomSongId);
                  const index = songs.findIndex(song => song.id == randomSongId);

                  if (index !== -1 && index !== currentSongIndex) {
                     currentSongIndex = index;
                     playSong(randomSongId);
                  }
               } else {
                  playRandomSong(); // Retry if the selected song is the same as the last played one or has been played before
               }

               // Check if all songs have been played, reset the array if true
               if (playedSongs.length === songs.length) {
                  playedSongs = [];
               }
         });
    }


   stopButton.addEventListener('click', pauseSong);
   nextButton.addEventListener('click', nextSong);
   prevButton.addEventListener('click', prevSong);
   randomButton.addEventListener('click', playRandomSong);
</script>