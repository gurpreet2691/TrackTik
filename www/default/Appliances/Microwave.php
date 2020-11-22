<?php 
namespace Appliances;

class Microwave {
     private $item;
    
    public function __construct() 
    {
      //  echo "this is Microwave class \n";
    }
    
    public function setItem(ElectronicItem $item): void
    {
        $this->item = $item;
    }
    
    public function getItem(): ElectronicItem
    {
        return $this->item;
    }
}