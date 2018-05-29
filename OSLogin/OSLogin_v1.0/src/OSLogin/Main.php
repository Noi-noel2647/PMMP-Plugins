<?php

namespace OSLogin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;

use pocketmine\utils\Config;



class Main extends PluginBase implements Listener {

	public function onEnable(){

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$plugin = "OSLogin";
		$this->getLogger()->notice("§a".$plugin." §3is loaded. §7(Dev. Noi)");
		$this->getLogger()->notice("§bTwitter §e@Noi_noel2647");
		$this->getLogger()->notice("§9GitHub §ehttps://github.com/shoki-3738");


		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);

		}

		$config = new Config($this->getDataFolder() . "Config.yml", Config::YAML,

					[
						"Android" => false,
						"iOS" => false,
						"OSX" => false,
						"FireOS" => false,
						"GearVR" => false,
						"Hololens" => false,
						"Windows10" => false,
						"Win32" => false,
						"Dedicated" => false,
						"Orbis" => false,
						"NX" => false,
					]
				);

		$this->cause = $config->getAll();

	}


	public function onPacketReceived(DataPacketReceiveEvent $event){

		$pk = $event->getPacket();

		if($pk instanceof LoginPacket){

			$data = $pk->clientData;
			$this->clientdata[$pk->username] = $data;//Login時に取ったデータを配列に一時保存

		}
	}


	public function onPlayerLogin(PlayerLoginEvent $event){

		$name = $event->getPlayer()->getName();
		$deviceOS = $this->getDeviceOS($name);	//player os
		$os = $this->getOS($deviceOS);

		$message = 	"§a§l=========================================§r\n".
				"§l§6 Sorry, This Server {$os} USER can't Login.§r\n".
				"§a§l=========================================§r";

		if($this->cause[$os] === true){
			$event->setKickMessage($message);
			$event->setCancelled();

		}
	}


	public function getDeviceOS($name){
		return $this->clientdata[$name]["DeviceOS"];

	}


	public function getOS($os){

		switch($os){

			case "1": return "Android";

			case "2": return "iOS";

			case "3": return "OSX";

			case "4": return "FireOS";

			case "5": return "GearVR";

			case "6": return "Hololens";

			case "7": return "Windows10";

			case "8": return "Win32";

			case "9": return "Dedicated";

			case "10": return "Orbis";

			case "11": return "NX";

			default: return "Unknown";

		}
	}
}