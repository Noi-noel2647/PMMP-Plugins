<?php


namespace ConfirmID;


use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Config;
use pocketmine\Player;



class ConfirmID extends PluginBase implements Listener{

	public function onEnable(){

		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		if(!file_exists($this->getDataFolder()))@mkdir($this->getDataFolder()); 
  		$this->config = new Config($this->getDataFolder() . "Item.yml", Config::YAML, ["item" => 352]);

		$this->item = $this->config->get("item");
	}




	public function onBlockTap(PlayerInteractEvent $event){


		if($event::RIGHT_CLICK_BLOCK === $event->getAction()){

			$player = $event->getPlayer();
			$block = $event->getBlock();

			$id = $block->getId();
			$meta = $block->getDamage();

			$hand = $player->getInventory()->getItemInHand()->getId();

			if($hand === $this->item){
				$player->sendMessage("§6[ConfirmID]§f 触ったブロックのIDは(".$id.":".$meta.")です");

			}
		}

	}



	public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool {

		if(strtolower($label) === "cid") {	//idcコマンドの処理

			if(!$sender instanceof Player){
				$sender->sendMessage("§e[ConfirmID]§c server内でコマンドを実行してください。");
				return true;

			}

			$item = $sender->getInventory()->getItemInHand();
			$id = $item->getID();
			$meta = $item->getDamage();
			$sender->sendMessage("§6[ConfirmID]§f 手に持ってる物のIDは(".$id.":".$meta.")です");

		}
		return true;
	}
}
