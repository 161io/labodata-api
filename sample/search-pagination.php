<?php
/**
 * LaboData (https://www.labodata.fr/)
 *
 * @link      https://github.com/161io/labodata-api for the canonical source repository
 * @copyright Copyright (c) 161 SARL. (https://161.io)
 */

require_once 'core.php';

$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
$page  = (int) (isset($_REQUEST['page']) ? $_REQUEST['page'] : '1');
$array = array();
if ($query) {
    $array = labodataQuery('https://www.labodata.fr/api/v1/product/search.json', array(
        'q'    => $query,
        'page' => $page,
    ));
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LaboData - La fiche de r&eacute;f&eacute;rence</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h1 class="mt-4"><a href="https://www.labodata.fr">LaboData</a> <small class="text-muted">Exemple d&rsquo;utilisation de la recherche</small></h1>

        <form action="search-pagination.php" method="get" class="my-4">
            <div class="input-group">
                <input type="search" class="form-control" name="q" value="<?php echo htmlspecialchars($query); ?>" required="required" placeholder="Rechercher dans LaboData">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>


        <?php if (!empty($array['error'])) : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erreur <?php echo $array['error']['code']; ?> :</strong> <?php echo $array['error']['message']; ?><br>
        </div>
        <?php endif; ?>


        <?php if (!empty($array['items'])) : ?>
        <h3 class="mb-3">R&eacute;sultat de la recherche <small class="text-muted"><?php echo htmlspecialchars($array['items_length']); ?> fiche(s) produit(s) trouv&eacute;e(s)</small></h3>
        <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Image</th>
                    <th>Marque</th>
                    <th>EAN</th>
                    <th>Titre &amp; Contenu</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($array['items'] as $item) : ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="" class="img-fluid mx-auto"></td>
                    <td><?php echo htmlspecialchars($item['brand']['title_fr']); ?></td>
                    <td><code><?php echo htmlspecialchars($item['code']); ?></code></td>
                    <td>
                        <?php echo htmlspecialchars($item['title_fr']); ?><br>
                        <small class="text-muted"><?php echo htmlspecialchars($item['content_fr']); ?></small>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <nav>

            <?php
                // Preparation de la pagination
                $first = 1;
                $last  = $array['page_length'];

                $prev = $array['page_number'] - 1;
                $next = $array['page_number'] + 1;
                if ($prev < $first) { $prev = $first; }
                if ($next > $last)  { $next = $last; }

                $paginationStart = $array['page_number'] - 5;
                $paginationEnd   = $array['page_number'] + 5;
                if ($paginationStart < $first) { $paginationStart = $first; }
                if ($paginationEnd > $last)    { $paginationEnd = $last; }
            ?>

            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="search-pagination.php?q=<?php echo urlencode($query); ?>&amp;page=<?php echo $first; ?>">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="search-pagination.php?q=<?php echo urlencode($query); ?>&amp;page=<?php echo $prev; ?>">&lsaquo;</a></li>
                <?php for ($p = $paginationStart; $p <= $paginationEnd; ++$p) : ?>
                    <li class="page-item<?php echo ($p == $array['page_number'] ? ' active' : ''); ?>"><a class="page-link" href="search-pagination.php?q=<?php echo urlencode($query); ?>&amp;page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
                <?php endfor; ?>
                <li class="page-item"><a class="page-link" href="search-pagination.php?q=<?php echo urlencode($query); ?>&amp;page=<?php echo $next; ?>">&rsaquo;</a></li>
                <li class="page-item"><a class="page-link" href="search-pagination.php?q=<?php echo urlencode($query); ?>&amp;page=<?php echo $last; ?>">&raquo;</a></li>
            </ul>
        </nav>
        <?php endif; ?>


    </div>

    <a href="https://github.com/161io/labodata-api" target="_blank">
        <img style="position:absolute; top:0; right:0; border:0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png">
    </a>
</body>
</html>
