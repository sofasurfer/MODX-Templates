<?php

define('FACEBOOK_SDK_V4_SRC_DIR','/media/data/git/MODX-Templates/core/components/Facebook');
require_once FACEBOOK_SDK_V4_SRC_DIR. '/autoload.php';



$fb = new Facebook\Facebook([
  'app_id' => '{app-id}',
  'app_secret' => '{app-secret}',
  'default_graph_version' => 'v2.5',
]);


$fb->setDefaultAccessToken('{access-token}');

try {
  $response = $fb->get('/me');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  return 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  return 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

return 'Logged in as ' . $userNode->getName();