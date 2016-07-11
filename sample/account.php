<?php
/**
 * LaboData (https://www.labodata.fr/)
 *
 * @link      https://github.com/161io/labodata-api for the canonical source repository
 * @copyright Copyright (c) 2015-2016 161 SARL. (http://161.io)
 */

require_once 'core.php';

$array = labodataQuery('https://www.labodata.fr/api/v1/account.json');

echo '<pre>';
var_export($array);
echo '</pre>';
