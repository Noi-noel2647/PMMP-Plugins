<?php

namespace FligtArea;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\Config;


class Main extends PluginBase implements Listener {

	public function onEnable() {

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->notice("§a範囲浮遊 §e==§bFreedom Flight§e== §dis Loaded. §6[Author] Noi");

		if(!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0744, true);
		$this->data = new Config($this->getDataFolder() . "AreaSetting.yml", Config::YAML,
					[
						"Area" =>
								[
									'x1' => 1,
									'y1' => 1,
									'z1' => 1,
									'x2' => 2,
									'y2' => 2,
									'z2' => 2,
								],
                 			]);
		$this->pos = $this->data->getAll()["Area"];

	}
 

	public function onPlayerMove(PlayerMoveEvent $event){

		$player = $event->getPlayer();
		$x = $player->x;
		$y = $player->y;
		$z = $player->z;
		
		if($x >= $this->pos['x1'] && $x <= $this->pos['x2']){
			if($y >= $this->pos['y1'] && $y <= $this->pos['y2']){
				if($z >= $this->pos['z1'] && $z <= $this->pos['z2']){
					$player->setFlying(true);

				}else{
					$player->setFlying(false);

				}
			}
		}
	}
}
