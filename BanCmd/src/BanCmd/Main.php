<?php

namespace BanCmd;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

	public function onEnable(){

		$plugin = "BanCmd";
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§a".$plugin."§eを読み込みました");
		$this->getLogger()->info("§c[コードも見てね] -§dDev.§6Noi-");

		if(!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0744, true);
		$this->config = new Config($this->getDataFolder() . "bancommands.yml", Config::YAML);

	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) :bool {

		switch(strtolower($label)){
			case "bancmd":  if(!isset($args[0])){
						$sender->sendMessage("§e[BanCmd] §3コマンドの書き方が間違ってます");
						return false;

					}else{
						if(!$this->config->exists($args[0])){
							$this->config->set($args[0]);
							$this->config->save();
							$sender->sendMessage("§e[BanCmd] §a{$args[0]} コマンドの使用を禁止しました");
						}
					}
				break;
						
			case "unbancmd": if(!isset($args[0])){
						$sender->sendMessage("§e[BanCmd] §3コマンドの使用方法が間違っています");
						return false;

					}else{
						if($this->config->exists($args[0])){
							$this->config->remove($args[0]);
							$this->config->save();
							$sender->sendMessage("§e[BanCmd] §b{$args[0]} コマンドの使用禁止を解除しました");

						}else{
							$sender->sendMessage("§e[BanCmd] {$args[0]} コマンドは使用禁止されてません");

						}
					}
				break;
		}
	}

	public function onPlayerCommandPreprocess(PlayerCommandPreprocessEvent $event){
					
		$mes = explode(" ", $event->getMessage());
		$player = $event->getPlayer();
		
		if(!$player->isOp()){

			if($this->config->exists($mes[0])){
				$event->setCancelled();
				$player->sendMessage("§c[§BanCmd] §e{$mes[0]}§c コマンドはBanされています。");

			}
		}
        }
}
