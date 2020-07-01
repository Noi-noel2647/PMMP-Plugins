<?php

namespace FloatingInfo;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\entity\Entity;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\utils\UUID;
use pocketmine\network\mcpe\protocol\AddPlayerPacket;

use pocketmine\event\player\PlayerJoinEvent;


class Main extends PluginBase implements Listener {

	public function onEnable(){

		date_default_timezone_set('Asia/Tokyo');

		$pm = $this->getServer()->getPluginManager();
		$pm->registerEvents($this, $this);


		if(!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0744, true);
			$config = new Config($this->getDataFolder() . "Config.yml", Config::YAML,

					[
						"x" => 128,
						"y" => 11,
						"z" => 128,
					]);

		$config = $config->getAll();
		$timer = 20;
		$x = (float) $config["x"];
		$y = (float) $config["y"];
		$z = (float) $config["z"];

		$eid = Entity::$entityCount++;
		$pos = new Vector3($x, $y, $z);	//vector3

		$pk = new AddPlayerPacket();

			$pk->uuid = UUID::fromRandom();
			$pk->username = "FloatInfo";
			$pk->entityUniqueId = $eid;
			$pk->entityRuntimeId = $eid;
			$pk->position = $pos;
			$pk->item = Item::get(Item::AIR);

			$flags = Entity::DATA_FLAG_IMMOBILE;

			$pk->metadata = [
						Entity::DATA_FLAGS => [Entity::DATA_TYPE_LONG, $flags],
						Entity::DATA_SCALE => [Entity::DATA_TYPE_FLOAT, 0],
					];

		$this->FloatInfo = $pk;



		$task = new UpdataTask($this, $eid);
		$this->getScheduler()->scheduleRepeatingTask($task, $timer);

	}


	public function onJoin(PlayerJoinEvent $event){
		$event->getPlayer()->dataPacket($this->FloatInfo);

	}




}