<?php
namespace Appliances;

class ElectronicItems
{
    private $items = [];
    
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getSortedItems(): array
    {
        $sorted = array();
        foreach ($this->items as $item)
        {
            $sorted[($item->getItem()->price * 100)] = $item;
        }
        
        ksort($sorted, SORT_NUMERIC);
        
        return $this->items = $sorted;
    }

    public function getItemsByType(string $type)
    {
        if (in_array($type, ElectronicItem::$types))
        {
            $callback = function($item) use ($type)
        {
            return $item->type == $type;
        };
            $items = array_filter($this->items, $callback);
        }
        
        return false;
    }
    
    public function getTotalPrice(array $items): int
    {
        $price = 0;

        foreach ($this->items as $item)
        {
            $controller_price = 0;
            if (in_array($item->getItem()->getType(), [ElectronicItem::ELECTRONIC_ITEM_CONSOLE, ElectronicItem::ELECTRONIC_ITEM_TELEVISION])) {
                $result = $this->getControllerData($item->getController());
                $controller_price = $result['remote_controller_price'] + $result['wired_controller_price'];
            }

            $price += ( $item->getItem()->price + $controller_price ) ;
        }
        
        return $price;
    }
    
    public function printBill(): array
    {
        $output = [];
        foreach ($this->items as $item)
        {
            $result = [];
            if (in_array($item->getItem()->getType(), [ElectronicItem::ELECTRONIC_ITEM_CONSOLE, ElectronicItem::ELECTRONIC_ITEM_TELEVISION])) {
                $result = $this->getControllerData($item->getController());
            }

            if (!empty($result)) {
                $max_extra = $result['controller_count_data'];
                foreach($max_extra as $key => $value)
                {
                    if (in_array($item->getItem()->getType(), [ElectronicItem::ELECTRONIC_ITEM_CONSOLE, ElectronicItem::ELECTRONIC_ITEM_TELEVISION])) {
                        if (Console::MAX_REMOTE_CONTROLLER_ALLOWED < $value || Console::MAX_WIRED_CONTROLLER_ALLOWED < $value) {
                            throw new \Exception('Cannot add more ' . $key . ' controllers for '. $item->getItem()->getType());
                        }
                    }
                }
            }

            array_push($output, [
                'name' => $item->getItem()->getType(),
                'controllers' => (!empty($result) ? $result['controller'] : []),
                'price' => $item->getItem()->price
            ]);
        }

        return $output;
    }

    private function getControllerData(array $controllers): array
    {
        $controller_count_data = [];
        $remote_price = 0;
        $wired_price = 0;
        $type = '';
        $controller_data = [];
        foreach ($controllers as $controller) {
            if (strtolower($controller->getControllerType() === Console::TYPE_REMOTE)) {
                $type = Console::TYPE_REMOTE;
                $remote_price += $controller->getRemoteControllerPrice();
            } else if (strtolower($controller->getControllerType()) === Console::TYPE_WIRED) {
                $type =  Console::TYPE_WIRED;
                $wired_price += $controller->getWiredControllerPrice();
            }

            $controller_count_data[$type] = $controller_count_data[$type] + 1;

            $controller_data[] = [
                'type' => $type,
                'price' => $type === Console::TYPE_WIRED ? $controller->getWiredControllerPrice() : $controller->getRemoteControllerPrice()
            ];
        }

        return [
            'controller' => $controller_data,
            'remote_controller_price' => $remote_price,
            'wired_controller_price' => $wired_price,
            'controller_count_data' => $controller_count_data
        ];
    }
}