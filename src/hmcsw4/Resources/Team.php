<?php

namespace HMCSW4\Client\Resources;

class Team extends Resource
{
  public function get($team_id, $service_id){
    return $this->HMCSW4->getRequest()->get("user/teams/".$team_id."/services/".$service_id."/proxmox");
  }

}