<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/functions.php' ?>

<?php

$result = "";

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $result = getMp3($url);
        redirect_to($result->file);
        $result = "{$result->YoutubeAPI->titolo} has been downloaded.";
    } else {
        $result = "The URL is not valid.";
    }
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6" style="margin-top: 5rem;">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                <h2 class="fw-bold text-light mb-3">Download song</h2>
                <div class="mb-3">

                    <label for="url" class="form-label text-light">Youtube Song URL</label>
                    <input type="text" name="url" id="url" class="form-control" placeholder="Enter youtube url here">

                </div>
                <button type="submit" class="btn btn-primary">Download</button>
            </form>
            <?php if ($result != "") { ?>
                <div class="alert alert-info my-3" role="alert">
                    <?= $result ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Include the JavaScript file -->
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>

</html>