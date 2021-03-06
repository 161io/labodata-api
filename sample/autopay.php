<?php
/**
 * LaboData (https://www.labodata.com)
 *
 * @link      https://github.com/161io/labodata-api for the canonical source repository
 * @copyright Copyright (c) 161 SARL. (https://161.io)
 */

require_once 'core.php';

$array = labodataQuery('https://www.labodata.com/api/v1/autopay.json', array(
    'redirect' => 'https://mon-url-de-retour', // facultatif
));

if (!empty($array['autoconnect'])) {
    header('Location: ' . $array['autoconnect']);
    echo '<p><a href="' . htmlspecialchars($array['autoconnect']) . '">Approvisionner mon compte LaboData</a></p>';
} else {
    echo '<h1>Error</h1>';
    echo '<pre>';
    var_export($array['error']);
    echo '</pre>';
}
