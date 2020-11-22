<?php
require("vendor/autoload.php");
require('Appliances/Console.php');
require('Appliances/Controller.php');
require('Appliances/ElectronicItem.php');
require('Appliances/ElectronicItems.php');
require('Appliances/Microwave.php');
require('Appliances/Television.php');

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Appliances\ElectronicItem;
use Appliances\ElectronicItems;
use Appliances\Controller;
use Appliances\Console;
use Appliances\Microwave;
use Appliances\Television;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

//$console_controller = [];

$electronic_item_console = new ElectronicItem();
$electronic_item_console->setType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE);
$electronic_item_console->setPrice(450);
$electronic_item_console->setWired(true);

$electronic_item_tv1 = new ElectronicItem();
$electronic_item_tv1->setType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
$electronic_item_tv1->setPrice(1200);
$electronic_item_tv1->setWired(true);

$electronic_item_tv2 = new ElectronicItem();
$electronic_item_tv2->setType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION);
$electronic_item_tv2->setPrice(1000);
$electronic_item_tv2->setWired(true);

$electronic_item_microwave = new ElectronicItem();
$electronic_item_microwave->setType(ElectronicItem::ELECTRONIC_ITEM_MICROWAVE);
$electronic_item_microwave->setPrice(200);
$electronic_item_microwave->setWired(true);

$controller_remote = new Controller();
$controller_remote->setControllerType(Console::TYPE_REMOTE);
$controller_remote->setRemoteControllerPrice(100);

$controller_wired = new Controller();
$controller_wired->setControllerType(Console::TYPE_WIRED);
$controller_wired->setWiredControllerPrice(200);

$console = new Console();
$console->setItem($electronic_item_console);
$console->setController([$controller_remote, $controller_remote, $controller_wired, $controller_wired]);

$tv1 = new Television();
$tv1->setItem($electronic_item_tv1);
$tv1->setController([$controller_remote, $controller_remote]);

$tv2 = new Television();
$tv2->setItem($electronic_item_tv2);
$tv2->setController([$controller_remote]);

$microwave = new Microwave();
$microwave->setItem($electronic_item_microwave);

$cart = [$console, $tv1, $tv2, $microwave];
try{
	$items = new ElectronicItems($cart);
	$bill = $items->printBill();
	$total_price = $items->getTotalPrice($cart);

	echo "<h3>Before Sorting</h3>";
	echo $twig->render('bill.html.twig', ['data' => $bill, 'total_price' => $total_price]);

	$sort = $items->getSortedItems();
	$bill = $items->printBill();

	echo "<h3>After Sorting</h3>";
	echo $twig->render('bill.html.twig', ['data' => $bill, 'total_price' => $total_price]);

} catch(\Exception $e) {
    echo "<error>" . $e->getMessage() . "</error>";
}