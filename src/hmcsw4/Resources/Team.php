<?php

namespace HMCSW4\Client\Resources;

class Team extends Resource
{
  public int $team_id;

  public function __construct ($HMCSW, int $team_id)
  {
    parent::__construct($HMCSW);
    $this->team_id = $team_id;
  }
  
  public function getRequest(){
    return $this->HMCSW4->getRequest();
  }

  public function getService(int $service_id): Service
  {
    return new Service($this, $this->team_id, $service_id);
  }
  
  public function get(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id);
  }

  public function orderProxmoxCal(int $disk, int $memory, int $cores, int $ipv4, int $ipv6){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/reselling/order/proxmox/cal", [], [], ["disk" => $disk, "memory" => $memory, "cores" => $cores, "ipv4" => $ipv4, "ipv6" => $ipv6]);
  }
  
  public function orderProxmoxBuy(int $disk, int $memory, int $cores, int $ipv4, int $ipv6){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/reselling/order/proxmox/buy", [], [], ["disk" => $disk, "memory" => $memory, "cores" => $cores, "ipv4" => $ipv4, "ipv6" => $ipv6]);
  }
  
  public function orderBuy(int $product_id){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/reselling/order/byID/".$product_id);
  }
  
}