<?php

namespace Noi\tasks;

use pocketmine\scheduler\Task;


class MessageTask extends Task {

	public function __construct($owner, $time) {

		$this->owner = $owner;
		$this->time = $time;
		$this->MinCount = 5;		//分カウンター

		if($time >= 72000){
			$this->HourCount = intval($time / 72000);	//$timeは〇時間かを$this->countに代入

		}

	}


	public function onRun(int $tick){		//1200tickごとに処理

		$this->TimeSchedule();

	}




	private function TimeSchedule() {

		if(!empty ($this->HourCount) ) {

			if($this->time == ($this->HourCount * 72000)) {			//１時間単位でメッセージを表示
				$this->owner->getServer()->broadcastMessage(" §e[Server] §b再起動§fまで §a残り{$this->HourCount}時間 §fです");
				$this->HourCount--;

			}
		}

		if($this->time == $this->MinCount * 10 * 1200) {			//10分単位でメッセージを表示
			$this->owner->getServer()->broadcastMessage(" §e[Server] §b再起動§fまで §a残り". $this->MinCount * 10 ."分 §fです");
			$this->MinCount--;

		}else if($this->time === 6000) {
			$this->owner->getServer()->broadcastMessage(" §e[Server] §b再起動§fまで §a残り5分 §fです");

		}else if($this->time === 1200) {
			$this->owner->getServer()->broadcastMessage(" §e[Server] §b再起動§fまで §c残り1分 §fです");


		}

		$this->time -= 1200;

	}

}