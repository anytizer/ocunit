<?php
$success = array_key_exists("HTTP_X_PROTECTION_TOKEN", $_SERVER);

header("Content-Type: application/json");
echo json_encode(array(
    "success" => $success
));
