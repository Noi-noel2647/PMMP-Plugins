<?php

namespace Keeps;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\scheduler\Task;
use pocketmine\math\AxisAlignedBB;

class Main extends PluginBase implements Listener {


	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

	}

	public function onPlayerDeath(PlayerDeathEvent $event) {

		$player = $event->getPlayer();
		$name = $player->getName();

		$event->setKeepInventory(true);
		$this->players[$name] = $player->getCurrentTotalXp();


		$level = $player->getLevel();
		$x = $player->x;
		$y = $player->y;
		$z = $player->z;
		$AxisAlignedBB = new AxisAlignedBB($x-3, $y-3, $z-3, $x+3, $y+3, $z+3);


		$task = new DelDropXpTask($this, $AxisAlignedBB, $level);
		$this->getScheduler()->scheduleDelayedTask($task, 10);


	}



	public function onPlayerRespawn(PlayerRespawnEvent $event) {

		$player = $event->getPlayer();
		$name = $player->getName();

		if(isset($this->players[$name])) {
			$task = new SendXpTask($this, $player);
			$this->getScheduler()->scheduleDelayedTask($task, 10);

		}
	}
}

