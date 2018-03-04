<?php

namespace Noi;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\Config;

class AutoStop extends PluginBase{

	public function onEnable(){


		$this->getLogger()->info("§aAutoStop§e を読み込みました。");
		$this->getLogger()->info("§f何かあれば§bTwitter §e@Noi_noel2647 §fまで §b(by Noi)");

		if(!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0744, true);

		$config = new Config($this->getDataFolder() . "config.yml", Config::YAML,
 				[
					"閉じる時間(1秒:20 1分:1200 1時間:72000)" => 72000,
					"メッセージ" => "サーバーを閉じました@n§a再起動しています",
				]);


		$time = $config->get("閉じる時間(1秒:20 1分:1200 1時間:72000)");
		$ms = str_replace("@n", "\n", $config->get("メッセージ"));


		$task = new ShutdownTask($this, $ms);
		$task2 = new ScheduleTask($this, $time);

		$this->getServer()->getScheduler()->scheduleDelayedTask($task, $time);
		$this->getServer()->getScheduler()->scheduleRepeatingTask($task2, 1200);

	}

}
