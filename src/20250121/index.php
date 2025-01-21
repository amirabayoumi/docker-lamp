<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require('db.inc.php');
$errors = [];

print '<pre>';
print_r($_FILES);
print '</pre>';


function randomName()
{
    return bin2hex(random_bytes(16));
}

if (isset($_POST["formSubmit"])) {
    print '<pre>';
    print_r($_POST);
    print '</pre>';
    // Check for upload errors in file
    if ($_FILES["imgupload"]["error"] > 0) {
        $errors[] = "Error: " . $_FILES["imgupload"]["error"];
        $uploadOk = 0;
    } else {
        $uploadOk = 1;
    }
    // Validation file type ( if img or not)
    if (isset($_FILES["imgupload"]["tmp_name"]) && !empty($_FILES["imgupload"]["tmp_name"])) {
        $check = getimagesize($_FILES["imgupload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $errors[] = "File is not an image.";
            $uploadOk = 0;
        }
    }


    $imageFileType = strtolower(pathinfo($_FILES["imgupload"]["name"], PATHINFO_EXTENSION));
    // Allow only jpg, jpeg, png
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $errors[] = "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Allow only file size up to 1MB
    if ($_FILES["imgupload"]["size"] > 1000000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $errors[] = "Sorry, your file was not uploaded.";
    } else {
        // no errors , upload file 
        $target_dir = "uploads/";
        $target_file = $target_dir . randomName() . "." . $imageFileType;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        if (move_uploaded_file($_FILES["imgupload"]["tmp_name"], $target_file)) {
            $success = "The file has been uploaded.";
            insertDbImage($target_file);
            unset($_FILES['imgupload']);
            unset($_POST['formSubmit']);
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }
}
$items = getDbImages();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DB Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <style>
        img.thumb {
            height: 50px;
        }
    </style>
</head>

<body>


    <div class="container">
        <section>
            <h2>Upload Image</h2>
            <hr />
            <?php if (isset($success)) : ?>
                <div class="alert alert-success" role="alert">
                    <ul>
                        <li><?= $success; ?></li>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if (count($errors)) : ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php" enctype="multipart/form-data">

                <div class="form-group mt-3">
                    <label for="imgupload" class="col-sm-2 col-form-label">Image: *</label>
                    <div>
                        <input type="file" name="imgupload" id="imgupload">
                    </div>
                </div>

                <div class="form-group mt-5">
                    <div>
                        <button type="submit" class="btn btn-primary" name="formSubmit" style="width: 100%">Add</button>
                    </div>
                </div>
            </form>


        </section>
        <main>


            <h2>Images</h2>
            <div class="table-responsive small">
                <table class="table table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($items as $item): ?>

                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?= '<img src="' . $item['path'] . '" class="thumb"/>'; ?></td>
                                <td><?= $item['created_date']; ?></td>

                            </tr>

                        <?php endforeach; ?>


                    </tbody>
                </table>


            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>