<?php

namespace EpEren\Fivem;

class ServerStatus{
  private bool $IsFivemBased=false;
  private string $ServerIdentifier;
  private $StreamContext;

  public static function ServerBased($ip,$port){
    return new ServerBased($ip,$port);
  }
 
  protected function MakeRequest($Url){
    $GetData=json_decode(@file_get_contents($Url,false,$this->StreamContext),true);
    return $GetData;
  }

  protected function SetStreamContext($Context){
    $this->StreamContext=$Context;
  }

}

  public function IsOnline(){
    $Data= $this->GetData();
    if($Data!=null){
      return true;
    }else{
      return false;
    }
  }

  public function GetCached(){
    return $this->CachedData;
  }

  public function Get(){
    return $this->GetData();
  }
}

class ServerBased extends ServerStatus{
  private string $Url;
  private array $CachedData=array();

  function __construct($ip,$port){
    $this->Url="http://".$ip.":".$port."/";
  }

  private function GetData(){
    try {
      $Data= parent::MakeRequest($this->Url."info.json");
      if($Data){
        $Data["players"]= parent::MakeRequest($this->Url."players.json");
        $this->CachedData= $Data;
        return $Data;
      }else{
        return null;
      }

    } catch (\Throwable $th) {
      return null;
    }
  }

  public function IsOnline(){
    $Data= $this->GetData();
    if($Data!=null){
      return true;
    }else{
      return false;
    }
  }

  public function GetCached(){
    return $this->CachedData;
  }

  public function Get(){
    return $this->GetData();
  }
}
