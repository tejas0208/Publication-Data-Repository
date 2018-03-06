<?php
if (is_ajax()) {
  if (isset($_POST["mis"]) && !empty($_POST["mis"])) { //Checks if action value exists
    $mis = $_POST["mis"];
    fetch_details($mis);
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function fetch_details($mis){
  $url = "http://172.16.1.45:9094/UserDetail/Index?MISNo=".$mis;
  $json = file_get_contents($url);
  echo $json;
}
?>

