<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/functions.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6" style="margin-top: 5rem;">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h2 class="fw-bold text-light mb-3">Upload song</h2>
                <div class="mb-3">
                    <label for="title" class="form-label text-light">Song title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter song title" required>
                </div>
                <div class="mb-3">
                    <label for="artist" class="form-label text-light">Song Artist</label>
                    <input type="text" name="artist" id="artist" class="form-control" placeholder="Enter artist name" required>
                </div>
                <div class="mb-3">
                    <label for="song_file" class="form-label text-light">Song File</label>
                    <input type="file" name="song_file" id="song_file" class="form-control" accept="audio/*" required>
                </div>
                <button type=" submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>


<?php
//check if song file has been uploaded
if (!empty($_FILES)) {

    $title = ucwords($_POST['title']);
    $artist = ucwords($_POST['artist']);
    $path = "music/" . $_FILES['song_file']['name'];

    if (move_uploaded_file($_FILES['song_file']['tmp_name'], $path)) {
        $file = fopen("songs.php", "r+");
        $new_data = "";
        $line = "";

        while (!feof($file)) {
            $line = fgets($file);
            $title = clean_data($title);
            $artist = clean_data($artist);
            $path = clean_data($path);
            $new_data .= str_replace(");", "\t[\n\t\t'title' => '$title', \n\t\t'artist' => '$artist', \n\t\t'path' => '$path' \n\t], \n);", $line);
        }
        fclose($file);
        file_put_contents("songs.php", $new_data);
    } else {
        echo $_FILES['song_file']['error'];
    }
}

?>

<!-- Include the JavaScript file -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>