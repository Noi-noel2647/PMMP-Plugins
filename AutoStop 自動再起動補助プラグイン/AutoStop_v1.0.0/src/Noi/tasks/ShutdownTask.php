<?php

namespace Noi\tasks;

use pocketmine\scheduler\Task;

class ShutdownTask extends Task {

	public function __construct($owner, $message) {

		$this->owner = $owner;
		$this->message = $message;

	}


	public function onRun(int $currentTick) {

		$players = $this->owner->getServer()->getOnlinePlayers();

		if($players == null) {
			$this->owner->getServer()->shutdown();

		} else {

			foreach($players as $player) {
				$player->kick($this->message, false);
				$this->owner->getServer()->shutdown();

			}
		}
	}

}