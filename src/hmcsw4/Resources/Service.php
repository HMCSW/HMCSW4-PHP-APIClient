<?php

namespace HMCSW4\Client\Resources;

use HMCSW4\Client\Resources\Service\Proxmox;

class Service extends Resource
{
  public int $team_id;
  public int $service_id;
  
  public const Proxmox = "proxmox";

  public function __construct ($HMCSW, int $team_id, int $service_id)
  {
    parent::__construct($HMCSW);
    $this->team_id = $team_id;
    $this->service_id = $service_id;
  }

  public function getRequest(){
    return $this->HMCSW4->getRequest();
  }
  
  public function get(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id);
  }

  public function getSpecifiedType($type = "proxmox"): Proxmox
  {
    return new Proxmox($this, $this->team_id, $this->service_id);
  }

  public function terminate(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/terminateService");
  }

  public function terminateInstant(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/terminateServiceInstant");
  }

  public function createSession(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/createSession");
  }

}