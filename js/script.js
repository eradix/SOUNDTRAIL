		// Set up the audio element 
		const audio = new Audio();

		//initialize variables
		let currentSongIndex = 0;
        const playButton = document.getElementById('play-button');
        const nextButton = document.getElementById('next-button');
        const prevButton = document.getElementById('prev-button');
        const volumeControl = document.getElementById('volume-control');
 
        let seekSlider = document.getElementById('seek-slider');

        //map thru songs and create list items for navbar
		let song_list = songList.map((song, index) => {
			return "<li class='dropdown-item songs text-truncate' id=" + index + "><a>" + song.title + "</a></li>";
		}).join(" ");

        //inject list items to the html
		document.querySelector("#songList").innerHTML = document.querySelector("#songList").innerHTML + song_list;

		//playbutton event
		playButton.addEventListener('click', function() {
			if (audio.paused) {
				audio.play();
				document.querySelector("#play-button").innerHTML = "<i class='fa-regular fa-circle-pause'></i>"
			} else {
				audio.pause();
				document.querySelector("#play-button").innerHTML = "<i class='fa-regular fa-circle-play'></i>"
			}
		});

		//next button event
		nextButton.addEventListener('click', function() {
			currentSongIndex++;
			if (currentSongIndex >= songList.length) {
				currentSongIndex = 0;
			}
			audio.src = songList[currentSongIndex].path;
			document.querySelector("#songTitle").innerHTML = songList[currentSongIndex].title;
			document.querySelector("#songArtist").innerHTML = songList[currentSongIndex].artist;
			audio.play();
			document.querySelector("#play-button").innerHTML = "<i class='fa-regular fa-circle-pause'></i>"
		});

		//prev button event
		prevButton.addEventListener('click', function() {
			currentSongIndex--;
			if (currentSongIndex < 0) {
				currentSongIndex = songList.length;
			}
			audio.src = songList[currentSongIndex].path;
			document.querySelector("#songTitle").innerHTML = songList[currentSongIndex].title;
			document.querySelector("#songArtist").innerHTML = songList[currentSongIndex].artist;
			audio.play();
			document.querySelector("#play-button").innerHTML = "<i class='fa-regular fa-circle-pause'></i>"
		});

		//volume range input
		volumeControl.addEventListener('input', function() {
			audio.volume = this.value;
		});

        //bind audio element to the seek slider
		audio.ontimeupdate = function() {
			let value = (100 / audio.duration) * audio.currentTime;
			seekSlider.value = value;
			document.querySelector("#current_time").innerHTML = fmtMSS(Math.floor(audio.currentTime));
		}

		seekSlider.oninput = function() {
			let seekTo = audio.duration * (seekSlider.value / 100);
			audio.currentTime = seekTo;
		}

        //function for getting time
		function fmtMSS(s) {
			return (s - (s %= 60)) / 60 + (9 < s ? ':' : ':0') + s
		}

        // Load and play the first song
		audio.src = songList[currentSongIndex].path;
		document.querySelector("#songTitle").innerHTML = songList[currentSongIndex].title;
		document.querySelector("#songArtist").innerHTML = songList[currentSongIndex].artist;

		// When the current song ends, play the next song
		audio.addEventListener('ended', function() {
			currentSongIndex++;
			if (currentSongIndex >= songList.length) {
				currentSongIndex = 0;
			}
			audio.src = songList[currentSongIndex].path;
			document.querySelector("#songTitle").innerHTML = songList[currentSongIndex].title;
			document.querySelector("#songArtist").innerHTML = songList[currentSongIndex].artist;
			audio.play();
			document.querySelector("#play-button").innerHTML = "<i class='fa-regular fa-circle-pause'></i>"
		});


		const song_li = document.querySelectorAll(".songs");
        //iterate thru each songs and add event, when click plays the specific song
		song_li.forEach((song, index) => {
			song.addEventListener('click', function() {
				currentSongIndex = this.id;
				audio.src = songList[currentSongIndex].path;
				document.querySelector("#songTitle").innerHTML = songList[currentSongIndex].title;
				document.querySelector("#songArtist").innerHTML = songList[currentSongIndex].artist;
				audio.play();
				document.querySelector("#play-button").innerHTML = "<i class='fa-regular fa-circle-pause'></i>"
			});
		});