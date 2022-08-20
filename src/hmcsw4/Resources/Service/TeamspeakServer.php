<?php

namespace HMCSW4\Client\Resources\Service;

use HMCSW4\Client\Request;
use HMCSW4\Client\Resources\Service;
use HMCSW4\Client\Resources\Resource;

class TeamspeakServer extends Service
{
  public function __construct ($HMCSW, int $team_id, int $service_id)
  {
    parent::__construct($HMCSW, $team_id, $service_id);
    $this->team_id = $team_id;
    $this->service_id = $service_id;
  }

  public function get(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/info");
  }
  
  public function startServer(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/start");
  }
  
  public function stopServer(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/stop");
  }
  
  public function createToken(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/token");
  }
  
  public function deleteToken(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/token");
  }

}
