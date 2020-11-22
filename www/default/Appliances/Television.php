<?php
namespace Appliances;

class Television {
    private $item;
    private $controller;
    
    public function __construct() 
    {
        $this->controller = [];
       // echo "this is television class \n";
    }

    public function setItem(ElectronicItem $item): void
    {
        $this->item = $item;
    }

    public function getItem(): ElectronicItem
    {
        return $this->item;
    }

    public function setController(array $controller): void
    {
        $this->controller = $controller;
    }

    public function getController(): array
    {
        return $this->controller;
    }
    

}