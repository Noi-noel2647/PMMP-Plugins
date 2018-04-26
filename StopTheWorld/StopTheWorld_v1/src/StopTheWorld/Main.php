<?php

namespace StopTheWorld;

use pocketmine\plugin\PluginBase;

use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;



	class Main extends PluginBase{

		public function onEnable(){

			$plugin = "StopTheWorld";
			$this->getLogger()->info("§a".$plugin."§eを読み込みました。 §f何かあれば§bTwitter §e@Noi_noel2647 §fまで §b(Author: Noi)");

		}



		public function onCommand(CommandSender $sender, Command $command, string $label, array $args) :bool {

			if(strtolower($label) === "wt"){

				if(strtolower($args[0]) == "start"){

					foreach($sender->getServer()->getLevels() as $level){
						$level->startTime();
					}

					$sender->sendMessage("全ワールドの時間が動きだしました");

				}elseif(strtolower($args[0]) == "stop"){

					foreach($sender->getServer()->getLevels() as $level){
						$level->stopTime();
					}

					$sender->sendMessage("全ワールドの時間を停止しました");
				}

			}
		return true;
		}
	}