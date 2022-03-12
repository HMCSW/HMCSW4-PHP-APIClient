<?php

namespace HMCSW4\Client\Resources\Service;

use HMCSW4\Client\Request;
use HMCSW4\Client\Resources\Service;
use HMCSW4\Client\Resources\Resource;

class Proxmox extends Service
{
  public function __construct ($HMCSW, int $team_id, int $service_id)
  {
    parent::__construct($HMCSW, $team_id, $service_id);
    $this->team_id = $team_id;
    $this->service_id = $service_id;
  }

  public function get(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/proxmox");
  }

  public function start(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/proxmox/start");
  }

  public function stop(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/proxmox/stop");
  }

  public function reboot(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/proxmox/reboot");
  }

  public function kill(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/proxmox/kill");
  }

  public function vnc(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/createSession");
  }
  
}