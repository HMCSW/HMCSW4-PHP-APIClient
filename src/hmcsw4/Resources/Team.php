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
  
  public function getServices(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services");
  }

  public function orderCustomCal(String $type, Array $args = []){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/reselling/order/".$type."/cal", [], [], $args);
  }
  
  public function orderCustomBuy(String $type, Array $args = []){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/reselling/order/".$type."/buy", [], [], $args);
  }
  
  public function orderBuy(int $product_id){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/reselling/order/byID/".$product_id);
  }
  
}
