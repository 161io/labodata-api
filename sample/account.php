<?php
/**
 * LaboData (https://www.labodata.fr/)
 *
 * @link      https://github.com/161io/labodata-api for the canonical source repository
 * @copyright Copyright (c) 161 SARL. (https://161.io)
 */

require_once 'core.php';

$array = labodataQuery('https://www.labodata.fr/api/v1/account.json');

echo '<pre>';
var_export($array);
echo '</pre>';
