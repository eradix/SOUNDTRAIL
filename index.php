<?php

require_once 'songs.php';
require_once 'includes/functions.php';


array_sort_by_column($songList, 'title');

echo "<script>
const songList = " . json_encode($songList) . "
</script>";

require_once 'includes/header.php'
?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6" style="margin-top: 5rem;">
			<div class="card text-center">
				<img src="images/audio.jpg" class="card-img-top" alt="...">
				<div class="card-body py-2 border-top">

					<h5 class="card-title display-6" id="songTitle"></h5>
					<p class="card-text lead text-muted" id="songArtist"></p>

					<!-- current time of audio -->
					<span id="current_time"></span><input type="range" id="seek-slider" value="0" max="100" class="w-100 py-2 control-buttons">
					<br>
					<!-- Add a button to skip to the next song -->
					<span id="prev-button" class="control-buttons" style="font-size: 2.2rem; color: #49796b;"><i class="fa-solid fa-circle-chevron-left"></i></span>&emsp;
					<!-- Add a button to toggle play/pause -->
					<span id="play-button" class="control-buttons" style="font-size: 2.5rem; color: #49796b;"><i class="fa-regular fa-circle-play"></i></span>&emsp;
					<!-- Add a button to skip to the next song -->
					<span id="next-button" class="control-buttons" style="font-size: 2.2rem; color: #49796b;"><i class="fa-solid fa-circle-chevron-right"></i></span>
					</br>
					<!-- volume button -->
					<div class="py-2"><span style="font-size: 1.7rem; color: #49796b;"><i class="fa-solid fa-volume-high"></i></span> <input type="range" min="0" max="1" step="0.01" value="1" id="volume-control" class="control-buttons"></div>

				</div>
			</div>
		</div>
	</div>
</div>


<!-- Include the JavaScript file -->
<!-- bootstrap5 js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- local js file -->
<script src="js/script.js"></script>
</body>

</html>