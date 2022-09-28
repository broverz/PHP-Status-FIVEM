<?php
include 'ServerStatus.php';
use EpEren\Fivem\ServerStatus;

$Server= ServerStatus::ServerBased("127.0.0.1","30120");
?>

<?php
if($Server->IsOnline()){
  $Data=$Server->GetCached();
  print_r($Data);
  echo '<h1>PLAYERS : ' . count($Data["players"]) . '</h1>';
  for ($i=0; $i <count($Data["players"]) ; $i++) {
    echo $Data["players"][$i]["name"];
    echo ' ' . $Data["players"][$i]["ping"] . '<br>';
  }
} else {
  echo "Offline";
}
?>
