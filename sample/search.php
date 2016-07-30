<?php
/**
 * LaboData (https://www.labodata.fr/)
 *
 * @link      https://github.com/161io/labodata-api for the canonical source repository
 * @copyright Copyright (c) 2015-2016 161 SARL. (http://161.io)
 */

require_once 'core.php';

$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
$array = array();
if ($query) {
    $array = labodataQuery('https://www.labodata.fr/api/v1/product/search.json', array(
        'q' => $query,
    ));
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaboData - La fiche de r&eacute;f&eacute;rence</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1><a href="https://www.labodata.fr">LaboData</a> <small>Exemple d&rsquo;utilisation de la recherche</small></h1>
        </div>

        <form action="search.php" method="get">
            <div class="input-group">
                <input type="search" class="form-control" name="q" value="<?php echo htmlspecialchars($query); ?>" required="required" placeholder="Rechercher dans LaboData">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Rechercher</button>
                </div>
            </div>
        </form>


        <?php if (!empty($array['error'])) : ?>
        <hr>
        <div class="alert alert-danger">
            <strong>Erreur <?php echo $array['error']['code']; ?> :</strong> <?php echo $array['error']['message']; ?><br>
        </div>
        <?php endif; ?>


        <?php if (!empty($array['items'])) : ?>
        <hr>
        <h3>R&eacute;sultat de la recherche <small><?php echo htmlspecialchars($array['items_length']); ?> fiche(s) produit(s) trouv&eacute;e(s)</small></h3>
        <table class="table table-striped table-hover">
            <thead>
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
                    <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="" class="img-responsive center-block"/></td>
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
        <?php endif; ?>


    </div>

    <a href="https://github.com/161io/labodata-api">
        <img style="position:absolute; top:0; right:0; border:0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png">
    </a>
</body>
</html>
