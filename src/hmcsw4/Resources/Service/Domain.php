<?php

namespace HMCSW4\Client\Resources\Service;

use HMCSW4\Client\Request;
use HMCSW4\Client\Resources\Service;
use HMCSW4\Client\Resources\Resource;

class Domain extends Service
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
  
  public function getAuthCode(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/authCode");
  }
  
  public function getDNS(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/dns");
  }
  
  public function addDNS(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/dns");
  }
  
  public function updateDNS(){
    return $this->HMCSW4->getRequest()->put("user/teams/".$this->team_id."/services/".$this->service_id."/dns");
  }
  
  public function deleteDNS(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/dns");
  }
  
  public function dnsHelper(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/dnsHelper");
  }
  
  public function setNameserver(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/nameserver");
  }

}
