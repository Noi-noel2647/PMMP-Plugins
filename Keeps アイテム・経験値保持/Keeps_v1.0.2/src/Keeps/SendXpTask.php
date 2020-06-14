<?php

namespace keeps;

use pocketmine\scheduler\Task;

class SendXpTask extends Task {

	public function __construct(Main $owner, $player) {

		$this->owner = $owner;
		$this->player = $player;

	}

	public function onRun(int $currentTick) {

		$name = $this->player->getName();
		$xp = $this->owner->players[$name];

		$this->player->setCurrentTotalXp($xp);
		unset($xp);

	}

}