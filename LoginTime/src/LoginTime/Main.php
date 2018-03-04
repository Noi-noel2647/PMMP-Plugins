<?php

namespace LoginTime;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;


class Main extends PluginBase implements Listener{

	public function onEnable(){

		date_default_timezone_set('Asia/Tokyo');

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§a[LoginTime]§eを読み込みましたよ～(^▽^)。§b Author：Noi");


		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}

		if(!is_dir($this->pdir = $this->getDataFolder()."players/")){
			mkdir($this->pdir);
		}

	}


	public function onPlayerJoin (PlayerJoinEvent $event) {

		$player = $event->getPlayer();
		$name = $player->getName();
		$this->LTime[$name]["Login"] = time();

	}


	public function onPlayerQuit(PlayerQuitEvent $event) {

		$player = $event->getPlayer();
		$name = $player->getName();
		$file = $this->getFileData($name);

		$this->LTime[$name]["Logout"] = time();

		$time = $this->TimeLag($name, $file);

		$file->set("ログイン時間", $time);
		$file->save();

	}


	public function TimeLag($name, $file){

		$intime = $this->LTime[$name]["Logout"] - $this->LTime[$name]["Login"];
		unset($this->LTime[$name]);

		if (!$file->exists("UnixTimeStamp")) {

			$file->set("UnixTimeStamp", 0);
			$file->save();

		}


		$time = $intime + $file->get("UnixTimeStamp");

		$file->set("UnixTimeStamp", $time);

		if ($time >= 86400) {

			$day = floor($time / 86400);
			$day1 = $time % 86400;

			$hour = floor($day1 / 3600);
			$hour1 = $day1 % 3600;

			$min = floor($hour1 / 60);

			return $time = "{$day}日 {$hour}時間 {$min}分";


		} elseif ($time >= 3600) {

			$hour = floor($time / 3600);
			$hour1 = $time % 3600;

			$min = floor($hour1 / 60);

			return $time = "0日 {$hour}時間 {$min}分";


		} elseif ($time >= 60) {

			$min = floor($time / 60);

			return $time = "0日 0時間 {$min}分";

		}
	}



	public function getFileData($name) {

		$data = new Config($this->pdir . $name.".yml", Config::YAML);
		return $data;
	}
}
