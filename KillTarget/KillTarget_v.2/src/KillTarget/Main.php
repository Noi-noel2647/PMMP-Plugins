<?php

namespace KillTarget;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;


class Main extends PluginBase {

const TITLE = "§a〔Kill Target〕§f ";

	public function onEnable(){

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

		$this->getLogger()->info("§aKillTaget §eを読み込みました。§b(製作者 Noiくん)");

		if (!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0744, true);
		$config = new Config($this->getDataFolder() . "config.yml", Config::YAML, 
					array(
						"ターゲット" => "Noi",
						"ターゲットの賞金" => 5000,
						"お金" => 300,
					));

		$economy = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		new KillTargetAPI($config, $economy);

	}




	public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool {

		if(isset($args[0]) && $sender->isOp()){

			switch (strtolower($args[0])) {//コマンド名で条件分岐

				case "help":

						$message = (
								"§e==== §bKill Targetのコマンド一覧・説明 §e====\n".
								"§f/target help   §aKill Targetのコマンド説明\n".
								"§f/target change    §aターゲットの変更ができます。\n".
								"§f/target money [value]   §aお金の確認・変更ができます。\n".
								"§f/target prize [value]   §a賞金の確認・変更ができます。\n".
								"§e=========================================");

						$sender->sendMessage($message);

						break;

				case "change":
						if(!isset($args[1])) return true;
						$player = $this->getServer()->getPlayer(strtolower($args[1]));

						if($player == null){
							$sender->sendMessage(self::TITLE. "§c『 ".$args[1]." 』§fという名前の§dプレイヤーは見つかりません§fでした。");
							KillTargetAPI::setTarget($args[1]);

						}else{
							$name = $player->getName();
							$sender->sendMessage(self::TITLE. "§dターゲット§fを§e《".$name."》§fに§6変更§fしました！");//プレイヤーにメッセージを送信
							$this->getServer()->broadcastMessage(self::TITLE. "§fターゲットが§e《".$name."》§fになりました。");
							KillTargetAPI::setTarget($name);

						}
						break;

				case "money":

						if(isset($args[1]) && ctype_digit($args[1])){
							$sender->sendMessage(Main::TITLE. "§e" .$args[1]. "§fに設定しました。");
							KillTargetAPI::setMoney($args[1]);

						}else{
							$money = KillTargetAPI::getMoney();
							$sender->sendMessage(Main::TITLE. "[money : §e" .$money. "§f]");

						}
						break;

				case "prize":

						if(isset($args[1]) && ctype_digit($args[1])){
							$sender->sendMessage(Main::TITLE. "§e" .$args[1]. "§fに設定しました。");
							KillTargetAPI::setPrize($args[1]);

						}else{
							$prize = KillTargetAPI::getPrize();
							$sender->sendMessage(Main::TITLE. "[prize : §e" .$prize. "§f]");

						}
						break;

			}

		}else{
			$sender->sendMessage(self::TITLE. "§f現在の§dターゲット§fは§e《".KillTargetAPI::getTarget()."》§fです!!");//プレイヤーにメッセージを送信

		}

		return true;
	}



	public function onDisable(){
		$this->getLogger()->info("§9KillTarget_Castamを終了しています...");

	}



}