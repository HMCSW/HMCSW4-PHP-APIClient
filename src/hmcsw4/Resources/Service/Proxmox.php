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
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/info");
  }

  public function stats(bool $chartJSReady = true, $by = "hour"){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/stats", [], [], array("chartJSReady" => $chartJSReady, "by" => $by));
  }

  public function start(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/start");
  }

  public function stop(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/stop");
  }

  public function reboot(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/reboot");
  }

  public function kill(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/kill");
  }

  public function vnc(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/createSession");
  }

  public function getRDNS(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id."/rdns");
  }

  public function createRDNS(int $ip_id, string $ip, string $content){
    return $this->HMCSW4->getRequest()->put("user/teams/".$this->team_id."/services/".$this->service_id."/rdns", [], [], array("ip_id" => $ip_id, "name" => $ip, "content" => $content));
  }

  public function deleteRDNS(string $ip){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/rdns", [], [], array("name" => $ip));
  }

  public function reinstall(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/reinstallVM");
  }

  public function addISO(string $name){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/iso", [], [], array("name" => $name));
  }

  public function removeISO(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/iso");
  }

  public function changePassword(string $password){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/changeRootPassword", [], [], ["password" => $password]);
  }

  public function createBackup(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/backup");
  }

  public function deleteBackup(string $name){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/backup", [], [], array("backupName" => $name));
  }

  public function restoreBackup(string $name){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/services/".$this->service_id."/backup", [], [], array("backupName" => $name));
  }

}