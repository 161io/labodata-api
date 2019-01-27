<?php
/**
 * LaboData (https://www.labodata.com)
 *
 * @link      https://github.com/161io/labodata-api for the canonical source repository
 * @copyright Copyright (c) 161 SARL. (https://161.io)
 */

define('LABODATA_AUTH_EMAIL', 'your@email');
define('LABODATA_AUTH_SECRET', 'your_secret_key');

/**
 * Executer une requete POST LaboData
 *
 * @param  string $urlJson
 * @param  array  $params
 * @return array
 */
function labodataQuery($urlJson, $params = array()) {
    if (!in_array('curl', get_loaded_extensions())) {
        echo '<p>cURL was not found <a href="https://secure.php.net/manual/en/book.curl.php" target="_blank">https://secure.php.net/manual/en/book.curl.php</a></p>';
        die();
    }

    $postfields = array_merge($params, array(
        'email'  => LABODATA_AUTH_EMAIL,
        'secret' => LABODATA_AUTH_SECRET,
    ));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlJson);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Facultatif selon votre serveur
    curl_setopt($ch, CURLOPT_USERAGENT, 'LaboData Sample');
    $output = curl_exec($ch);
    curl_close($ch);

    $array = json_decode($output, true);
    if (null === $array) {
        echo $output;
        return array();
    }
    return $array;
}
