<?php

namespace KeepInventory;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;


class Main extends PluginBase implements Listener {

   public function onEnable() {

      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      $plugin = "KeepInventory";
      $this->getLogger()->info("§a".$plugin."§eを読み込みました。 §f何かあれば§bTwitter §e@Noi_noel2647 §fまで §b(Author: Noi)");

   }

   public function onDeath(PlayerDeathEvent $event) {
      $event->setKeepInventory(true);

   }

}
