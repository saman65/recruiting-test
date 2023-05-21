<?php
function getPunkAPIInfo($beername) {
  $endpoint = "https://api.punkapi.com/v2/beers?beer_name=" . urlencode($beername);

  try {
    $response = file_get_contents($endpoint);
    $data = json_decode($response, true);

    if (!empty($data)) {
      $beer = $data[0];
      $imageUrl = $beer['image_url'];
      $id = $beer['id'];

      return ['imageUrl' => $imageUrl, 'id' => $id];
    } else {
      //throw new Exception('No beer found with the given name.');
      echo "";
    }
  } catch (Exception $e) {
    echo 'Error fetching Punk API: ' . $e->getMessage();
    throw $e;
  }
}

?>