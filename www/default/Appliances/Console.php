<?php
namespace Appliances;

class Console {
    const MAX_REMOTE_CONTROLLER_ALLOWED = 2;
    const MAX_WIRED_CONTROLLER_ALLOWED = 2;
    const TYPE_WIRED = 'wired';
    const TYPE_REMOTE = 'remote';
    
    private $controller;
    private $item;
    
    public function __construct() 
    {
        $this->controller = [];
       // echo "this is console class\n";
    }

    public function setController(array $controller): void
    {
        $this->controller = $controller;
    }

    public function getController(): array
    {
        return $this->controller;
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
