<?php

namespace KillTarget;


use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerMoveEvent;

use pocketmine\level\particle\DustParticle;
use pocketmine\math\Vector3;

use pocketmine\Player;
use pocketmine\Server;


class EventListener implements Listener {


	public function __construct(PluginBase $plugin){

		$this->plugin = $plugin;

	}


	public function onPlayerDeath(PlayerDeathEvent $event){

		$cause = $event->getPlayer()->getLastDamageCause();

		if ($cause instanceof EntityDamageByEntityEvent){
			$killer = $cause->getDamager();			//killer player obj

			if ($killer instanceof Player){
				$name = $event->getPlayer()->getName();	//dead player name
				$kn = $killer->getName();		//killer player name

				if ($name === KillTargetAPI::getTarget()){

					$prize = KillTargetAPI::getPrize();
					KillTargetAPI::giveMoney($kn, $prize);

					$killer->sendMessage(Main::TITLE. "§e『ターゲット：".$name."』§fを倒し、§6$".$prize."§f入手しました！");
					Server::getInstance()->broadcastMessage(Main::TITLE. "§eターゲット§fは§d[".$kn."]§fによって倒されました。");

				} else {

					$money = KillTargetAPI::getMoney();
					KillTargetAPI::giveMoney($kn, $money);

					$killer->sendMessage(Main::TITLE. "§c[".$name."]§fを倒し§6$".$money."§f手に入れました！");

				}
			}
		}
	}



	public function onPlayerMove(PlayerMoveEvent $event){

		$player = $event->getPlayer();
		$name = $player->getName();

		if($name === KillTargetAPI::getTarget()){
			$level = $player->getLevel();
			$pos = new Vector3($player->x, $player->y, $player->z);
			$pt = new DustParticle($pos, 67, 135, 233);
			$count = 25;

			for($i = 0;$i < $count; ++$i){
				$level->addParticle($pt);

			}
		}
	}


}

