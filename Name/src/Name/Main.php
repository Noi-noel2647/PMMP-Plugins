<?php

namespace Name;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;


class Main extends PluginBase implements Listener {


	public function onEnable() {

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$plugin = "Name";
		$this->getLogger()->info("§a".$plugin."§eを読み込みました。 §f何かあれば§bTwitter §e@Noi_noel2647 §fまで §b(Author: Noi)");

	}


	public function onLogin(DataPacketReceiveEvent $event) {

		$packet = $event->getPacket();

		if($packet instanceof LoginPacket){
			$name = $packet->username;

			if(strpos($name, " ") !== false){
				$newname = str_replace(" ", "_", $name);
				$packet->username = $newname;

			}
		}
	}

}
