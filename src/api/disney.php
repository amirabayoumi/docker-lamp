<?php
require('functions.inc.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$allItems = makeRequest('https://api.disneyapi.dev/character');
// print '<pre>';
// print($allItems->info->totalPages);
// print '</pre>';
// exit;




$pages = $allItems->info->totalPages;
// print $pages;
if (isset($_GET['page'])) {

    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}






$items = makeRequest('https://api.disneyapi.dev/character?pageSize=20&page=' . $currentPage);

// print '<pre>';
// print_r($items);
// print '</pre>';
// exit;

print '<table>
    <thead>    
        <td>ID</td>
        <td>image</td>
        <td>name</td>
        <td>movies</td>
    </thead>';

// foreach ($items->data as $item) {

//     print '<tr>';
//     print '<td>' . $item->_id . '</td>';

//     if (isset($item->imageUrl)) {
//         print '<td><img src="' . $item->imageUrl . '" width="100" /></td>';
//     } else {
//         print '<td>(image not set)</td>';
//     }

//     print '<td>' . $item->name . '</td>';
//     print '<td>' . implode(', ', $item->films) . '</td>';

//     print '</tr>';
// }

// print '</table>';



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
    <header style="height: 30vh;;">
        <h1 style="font-size: 50px; text-align:center;">Disney character</h1>
    </header>
    <main style="display:flex; flex-wrap:wrap; gap: 5rem;">
        <?php foreach ($items->data as $item): ?>
            <div class="card" style="width: 18rem; padding:1rem; background-color:#f8e8b4; text-align:center;">
                <img src="<?= $item->imageUrl; ?>" class="card-img-top" alt="..." style=" border-radius:50%; aspect-ratio:1/1;">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 25px;"><?= $item->name; ?></h5>
                    <p class="card-text">Films: <?= implode(', ', $item->films); ?></p>

                </div>
            </div>
        <?php endforeach; ?>
    </main>

    <footer>
        <nav aria-label="Page navigation example">
            <ul class="pagination">


                <li class="page-item " style="display:<?php if ($currentPage == 1) {
                                                            print "none";
                                                        } ?> "><a class="page-link" href="disney.php?page=<?php echo $currentPage - 1; ?>">Previous</a></li>
                <li class="page-item"><a class="page-link" href="disney.php?page=<?= 1; ?>">First</a></li>
                <!-- <?php for ($i = 1; $i <= $pages; $i++) : ?> <li>
                        <a class="page-link" href="disney.php?page=<?= $i; ?>"><?= $i; ?></a>

                    </li> <?php endfor; ?> -->
                <li class="page-item"><a class="page-link" href="disney.php?page=<?= $pages ?>">Last</a></li>
                <li class="page-item" style="display:  <?php if ($currentPage >= $pages) {
                                                            print "none";
                                                        } ?> "><a class="page-link" href="disney.php?page=<?= $currentPage  + 1; ?>" class="page-link">Next</a></li>

            </ul>
        </nav>

    </footer>

</body>

</html>