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
  
  public function getDomain(): Domain
  {
    return new Domain($this, $this->team_id, $this->service_id);
  }
  
  public function getPlesk(): Plesk
  {
    return new Plesk($this, $this->team_id, $this->service_id);
  }
  
  public function getPleskLicense(): PleskLicense
  {
    return new PleskLicense($this, $this->team_id, $this->service_id);
  }
  
  public function getProxmox(): Proxmox
  {
    return new Proxmox($this, $this->team_id, $this->service_id);
  }
  
  public function getPterodactyl(): Pterodactyl
  {
    return new Pterodactyl($this, $this->team_id, $this->service_id);
  }
  
  public function getTeamspeakInstance(): TeamspeakInstance
  {
    return new TeamspeakInstance($this, $this->team_id, $this->service_id);
  }
  
  public function getTeamspeakServer(): TeamspeakServer
  {
    return new TeamspeakServer($this, $this->team_id, $this->service_id);
  }
  
  public function get(){
    return $this->HMCSW4->getRequest()->get("user/teams/".$this->team_id."/services/".$this->service_id);
  }
  
  public function setServiceName(){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/services/".$this->service_id."/name");
  }
  
  public function toggleServiceLock(){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/services/".$this->service_id."/lock");
  }

  public function terminate(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/terminateService");
  }

  public function terminateInstant(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/terminateServiceInstant");
  }

  public function createSession(){
    return $this->HMCSW4->getRequest()->post("user/teams/".$this->team_id."/services/".$this->service_id."/createSession");
  }
  
  public function calculateRetour(){
    return $this->HMCSW4->getRequest()->delete("user/teams/".$this->team_id."/services/".$this->service_id."/calculateRetour");
  }
  
  public function reinstallService(){
    return $this->HMCSW4->getRequest()->patch("user/teams/".$this->team_id."/services/".$this->service_id."/reinstall");
  }

}
