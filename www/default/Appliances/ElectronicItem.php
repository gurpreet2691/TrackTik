<?php
namespace Appliances;

class ElectronicItem 
{
    public $price;
    protected $type;
    public $wired;
    
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    
    public static $types = [self::ELECTRONIC_ITEM_CONSOLE,
                    self::ELECTRONIC_ITEM_MICROWAVE, self::ELECTRONIC_ITEM_TELEVISION];
    
    public function getPrice(): int
    {
        return $this->price;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getWired()
    {
        return $this->wired;
    }
    
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
    
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    
    public function setWired($wired)
    {
        $this->wired = $wired;
    }
}