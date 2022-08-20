<?php

namespace HMCSW4\Client\Resources;

class User extends Resource
{

  public function __construct ($HMCSW)
  {
    parent::__construct($HMCSW);
  }
  
  public function getRequest(){
    return $this->HMCSW4->getRequest();
  }

  public function getService(int $service_id): Service
  {
    return new Service($this, $this->team_id, $service_id);
  }
  
  public function getInfo(){
    return $this->HMCSW4->getRequest()->get("user");
  }
  
  public function getServices(){
    return $this->HMCSW4->getRequest()->get("user/services");
  }
  
  public function getTeams(){
    return $this->HMCSW4->getRequest()->get("user/teams");
  }
  
  public function setNightMode(){
    return $this->HMCSW4->getRequest()->post("user/settings/general/nightMode");
  }
  
  public function sortBadges(){
    return $this->HMCSW4->getRequest()->post("user/settings/badges/sort");
  }
  
  public function getTwoFactors(){
    return $this->HMCSW4->getRequest()->get("user/settings/security/twoFactor");
  }
  
  public function getDevices(){
    return $this->HMCSW4->getRequest()->get("user/settings/devices");
  }
  
  public function deleteDevice(){
    return $this->HMCSW4->getRequest()->delete("user/settings/devices");
  }
  
  public function deleteDevices(){
    return $this->HMCSW4->getRequest()->delete("user/settings/devices/all");
  }
  
  public function getCreditHistory(){
    return $this->HMCSW4->getRequest()->get("user/settings/creditsHistory");
  }
  
  public function getPaymentHistory(){
    return $this->HMCSW4->getRequest()->get("user/settings/paymentHistory");
  }
  
  public function getMails(){
    return $this->HMCSW4->getRequest()->get("user/settings/mail");
  }
  
  public function getMail($mail_id){
    return $this->HMCSW4->getRequest()->get("user/settings/mail/".$mail_id);
  }
  
  public function getInvoices(){
    return $this->HMCSW4->getRequest()->get("user/invoices/");
  }
  
  public function getInvoice($invoice_id){
    return $this->HMCSW4->getRequest()->get("user/invoices/".$invoice_id);
  }
  
  public function getInvoiceFile($invoice_id){
    return $this->HMCSW4->getRequest()->get("user/invoices/".$invoice_id."/file");
  }
  
  public function payInvoice($invoice_id){
    return $this->HMCSW4->getRequest()->get("user/invoices/".$invoice_id."/pay");
  }
  
  public function getTeams(){
    return $this->HMCSW4->getRequest()->get("user/teams");
  }
  
  public function sortTeams(){
    return $this->HMCSW4->getRequest()->post("user/teams/sort");
  }
  
}
