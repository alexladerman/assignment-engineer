<?php

require_once __DIR__.'/../sdk/Client.php';
require_once __DIR__.'/../config.php';

$client = new Client();

$client->initialize($apiKey, $apiSecret);

$client->signIn($email, $password);

$options = array('limit' => 48);

$catalogs = $client->getCatalogList($options);

echo '<h1>Catalogs</h1>';
echo '<table>';
$len = count($catalogs);
for ($i = 0; $i < $len; ++$i) {
    echo '<tr><td>'.($i + 1).'</td><td>'.$catalogs[$i]->id.'</td><td>'.$catalogs[$i]->label.'</td></tr>';
}
echo '</table>';

$client->signOut();
$client->destroy();
