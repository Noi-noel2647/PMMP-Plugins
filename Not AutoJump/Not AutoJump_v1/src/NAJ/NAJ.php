<?php

namespace NAJ;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\player\PlayerJoinEvent;


class NAJ extends PluginBase implements Listener {

          public function onEnable() {
                 $this->getServer()->getPluginManager()->registerEvents($this, $this);
                 $plugin = "NotAutoJump";
                 $this->getLogger()->info("§a".$plugin."§eを読み込みました。§b『Noi』");


                 if(!file_exists($this->getDataFolder())){
                    mkdir($this->getDataFolder(), 0744, true);
                 }
                          $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array('ワールド名' => 'world'));
                          $this->world = $this->config->get('ワールド名');//ConfigからLevelネームの取得

          }

          public function onJoin(PlayerJoinEvent $event){

                 $player = $event->getPlayer();
                 $level = $player->getLevel()->getName();

                 if ($level == $this->world) {//移動先のワールド名とConfigのワールド名が同じだったら
                     $player->setAutoJump(false);
                     $player->save();

                 }else{//違ったら

                     $player->setAutoJump(true);
                     $player->save();
                 }
          }

          public function LevelChange(EntityLevelChangeEvent $event){

                 $entity = $event->getEntity();

                 if ($entity instanceof Player){//エンティティがプレイヤーオブジェクトかどうか？

                     $PW = $event->getTarget()->getName();//イベントから移動先のLevelネームを取得

                                  if ($PW == $this->world) {//移動先のワールド名とConfigのワールド名が同じだったら
                                      $entity->setAutoJump(false);
                                      $entity->save();

                                  }else{//違ったら

                                      $entity->setAutoJump(true);
                                      $entity->save();
                                  }
                 }
          }

          public function onDisable() {
             $plugin = "NotAutoJump";
             $this->getLogger()->info("§9".$plugin."を終了しています...");
          }
}
