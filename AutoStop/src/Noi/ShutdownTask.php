<?php

namespace Noi;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\PluginBase;

class ShutdownTask extends PluginTask{

	public function __construct(PluginBase $owner, $message){

		parent::__construct($owner);
		$this->message = $message;

	}


	public function onRun(int $tick){

		$players = $this->owner->getServer()->getInstance()->getOnlinePlayers();

		if($players == null){

			$this->owner->getServer()->shutdown();

		}else{

			foreach($players as $player){

				$player->kick($this->message, false);
				$this->owner->getServer()->shutdown();

			}
		}
	}

}