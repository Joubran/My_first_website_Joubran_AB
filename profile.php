<?php
if (!isset($_COOKIE['User'])) {
    header('Location: /login.php');
    exit();
}

$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'first');

if (isset($_POST['submit'])) {
    $title = $_POST['postTitle'];
    $main_text = $_POST['postContent'];

    if (!$title || !$main_text) {
        die("no data post");
    }

    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";

    if (!mysqli_query($link, $sql)) {
        die("error insert data post");
    }

    if (!empty($_FILES["file"]["name"])) {
        if (
            (
                ($_FILES["file"]["type"] == "image/gif") ||
                ($_FILES["file"]["type"] == "image/jpeg") ||
                ($_FILES["file"]["type"] == "image/jpg") ||
                ($_FILES["file"]["type"] == "image/pjpeg") ||
                ($_FILES["file"]["type"] == "image/x-png") ||
                ($_FILES["file"]["type"] == "image/png")
            )
            && ($_FILES["file"]["size"] < 102400)
        ) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "Load in: " . "upload/" . $_FILES["file"]["name"];
        } else {
            echo "upload failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alboni Joubran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="logohack.webp" alt="логотип-сайта" class="me-2">
                <span class="text-light">History</span>
            </a>

            <?php if (isset($_COOKIE['User'])): ?>
                <form action="/logout.php" method="POST" class="d-flex">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="story-container">
            <div class="story-text">
                <p>Well, Prince, so Genoa and Lucca are now just family estates of the Buonapartes. But I warn you, if you don't tell me that this means war, if you still try to defend the infamies and horrors perpetrated by that Antichrist, I really believe he is Antichrist, I will have nothing more to do with you.</p>
            </div>
            <img src="hack1.webp" alt="фото_хакера" class="hacker-img">
        </div>

        <div class="text-center mt-4">
            <button id="toggleButton" class="btn btn-primary">Open</button>
        </div>

        <div id="extraImage" class="mt-3 text-center" style="display: none;">
            <img class="hacker-img" src="hack2.webp" alt="скрытое_фото">
        </div>

        <div class="mt-5">
            <h2 class="text-center mb-4">Add New Post</h2>

            <form action="/profile.php" id="postForm" class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" for="postTitle">Post Title</label>
                    <input type="text" name="postTitle" class="form-control hacker-input" id="postTitle" placeholder="Enter post Title" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="postContent">Post Content</label>
                    <textarea name="postContent" class="form-control hacker-input" id="postContent" placeholder="Enter post Content" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="file">Upload file</label>
                    <input type="file" name="file" class="form-control hacker-input" id="file">
                </div>

                <button class="btn btn-primary" type="submit" name="submit">Save Post</button>
            </form>
        </div>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>