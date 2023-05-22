<?php
function getPunkAPIInfo($beername) {
  $endpoint = "https://api.punkapi.com/v2/beers?beer_name=" . urlencode($beername);

    $response = file_get_contents($endpoint);
    $data = json_decode($response, true);

    if (!empty($data)) {

      $beer = $data[0];
      $imageUrl = $beer['image_url'];
      $id = $beer['id'];

      return ['imageUrl' => $imageUrl, 'id' => $id];

    }else{

      echo "";

    }
}

function anonymizeUsername($username) {
  // Extract the first name and last name initials
  $nameParts = explode(' ', $username);
  //Split the String into an Array
  $firstName = $nameParts[0];
  $lastName = '';
  if (count($nameParts) > 1) {
    $lastName = $nameParts[count($nameParts) - 1];
  }

  // Generate the anonymized username
  $anonymizedFirstName = substr($firstName, 0, 3) . str_repeat('x', max(strlen($firstName) - 3, 0));
  $anonymizedLastName = '';
  if (!empty($lastName)) {
    $anonymizedLastName = substr($lastName, 0, 1) . '.';
  }

  return $anonymizedFirstName . ' ' . $anonymizedLastName;
}

?>