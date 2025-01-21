<?php
require("./functions.inc.php");

$items = getItems();

print "<pre>";
print_r($items);
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
    <header style="height:20vh; text-align:center">

        <h1> API </h1>
        <a href="./add.php" class="btn btn-primary active" aria-current="page">Add URL</a>

    </header>
    <main>
        <?php foreach ($items as $item): ?>
            <div class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $item['ogimage']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['ogtitle']; ?></h5>
                            <p class="card-text"><?= $item['ogdescription']; ?></p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>

</html>