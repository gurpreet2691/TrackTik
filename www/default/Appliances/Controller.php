<?php

namespace Appliances;

class Controller {
	private $remote_price;
	private $wired_price;
	private $type;

	public function getControllerType(): string
    {
        return $this->type;
    }

    public function setControllerType(string $type): void
    {
        $this->type = $type;
    }

	public function getRemoteControllerPrice(): int
	{
		return $this->remote_price;
	}

	public function setRemoteControllerPrice(int $price): void
	{
		$this->remote_price = $price;
	}

	public function getWiredControllerPrice(): int
	{
		return $this->wired_price;
	}

	public function setWiredControllerPrice(int $wired_price): void
	{
		$this->wired_price = $wired_price;
	}
}