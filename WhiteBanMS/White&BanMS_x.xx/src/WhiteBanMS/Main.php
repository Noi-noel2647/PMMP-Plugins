<?php

namespace WhiteBanMS;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;


class Main extends PluginBase implements Listener{


	public function onEnable(){

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§aWhiteMS §b& §aBannedMS §eを読み込みました。§b『製作者 Noi』");

		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}

		$config = new Config($this->getDataFolder() . "Config.yml", Config::YAML,
				[
					"Whitelist時のメッセージ"=> "現在サーバーは、ホワイトリスト中です。\n 限られたプレイヤーしか入れません。",
					"NameBan時のメッセージ" => "貴方は§eNameBanされています。\n §bサーバーに入れません！！",
					"IPBan時のメッセージ" => "貴方は§eIPBanされています。\n §bサーバーに入れません！！",
				]);

		$this->ms = $config->getAll();

	}



	public function Login(PlayerPreLoginEvent $event){

		$player = $event->getPlayer();
		$ip = $player->getAddress();
		$server = $this->getServer();

		if($server->hasWhitelist()){
			if(!$player->isWhitelisted()){
				$player->close($player->getLeaveMessage(), $this->ms[0]);

			}
		}


		if($player->isBanned()){	//NameBanの場合
			$player->close($player->getLeaveMessage(), $this->ms[1]);

		}elseif($server->getIPBans()->isBanned($ip)){	//IPBanの場合
			$player->close($player->getLeaveMessage(), $this->ms[2]);

		}
	}

}
