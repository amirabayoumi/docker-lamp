<?php
require("./functions.inc.php");

print "<pre>";
print_r($_POST);
print "</pre>";


$errors = [];

if (isset($_POST["submit"])) {
    if (isset($_POST["url"])) {
        if (strlen($_POST["url"]) < 1) {
            $errors[] = "url is required";
        }
    }
}


print "<pre>";
print_r($errors);
print "</pre>";



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

</head>

<body>
    <form action="add.php" method="post">
        <div class="mb-3" style="text-align: center;">
            <label for="exampleInputEmail1" class="form-label">add URl </label>
            <input type="text" class="form-control" id="url" name="url">

        </div>

        <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>