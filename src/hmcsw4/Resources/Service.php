<?php

namespace HMCSW4\Client\Resources;

use HMCSW4\Client\Resources\Service\Proxmox;

class Service extends Resource
{

  private int $team_id;
  private int $service_id;

  public function __construct ($HMCSW, int $team_id, int $service_id)
  {
    parent::__construct($HMCSW);
    $this->team_id = $team_id;
    $this->service_id = $service_id;
  }

  public function get(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id);
  }

  public function getSpecifiedType($type = "proxmox"): Proxmox
  {
    return new Proxmox($this);
  }

}