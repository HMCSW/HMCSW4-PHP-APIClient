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
  
  public function updateTeamName(){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/settings/updateName");
  }
  
  public function getTeamMembers(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/members");
  }
  
  public function addTeamMembers(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/members");
  }
  
  public function updateTeamMembers(){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/members");
  }
  
  public function removeTeamMembers(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/members");
  }
  
  public function getGroups(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/groups");
  }
  
  public function setGroupsPermission(int $group_id){
    return $this->HMCSW4->getRequest()->put("user/teams/".$this->team_id."/groups".$group_id."/permission");
  }
  
  public function setSSHKeyAutoInstall(int $sshKey_id){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/sshKeys/".$sshKey_id."/autoInstall");
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
