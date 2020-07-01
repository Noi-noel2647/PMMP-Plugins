<?php

namespace Noi;

use pocketmine\plugin\PluginBase;
use Noi\tasks\{MessageTask, ShutdownTask};

class AutoStop extends PluginBase {

	public function onEnable() {

		$time = $this->getConfig()->get('time');
		$ms = str_replace("@n", "\n", $this->getConfig()->get('message'));

		$task = new ShutdownTask($this, $ms);
		$task2 = new MessageTask($this, $time);

		$this->getScheduler()->scheduleDelayedTask($task, $time);
		$this->getScheduler()->scheduleRepeatingTask($task2, 1200);

	}

}



/*
	ToDo:

		‚PŠÔ	1h
		‚P•ª	1m		1h15m30s “I‚ÉConfigƒtƒ@ƒCƒ‹‚Åİ’è‚³‚¹‚é
		‚P•b	1s

*/