<?php

namespace Noi;

use pocketmine\scheduler\Task;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class ShutdownTask extends Task{

	public function __construct(PluginBase $owner, $message){

		$this->message = $message;

	}


	public function onRun(int $tick){

		$players = Server::getInstance()->getOnlinePlayers();

		if($players == null){

			Server::getInstance()->shutdown();

		}else{

			foreach($players as $player){

				$player->kick($this->message, false);
				Server::getInstance()->shutdown();

			}
		}
	}

}