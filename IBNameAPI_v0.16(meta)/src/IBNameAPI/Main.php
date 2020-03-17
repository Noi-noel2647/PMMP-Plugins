<?php

namespace IBNameAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;


class Main extends PluginBase implements Listener{

          public function onEnable(){

                 $plugin = "IBNameAPI";
                 $this->getLogger()->info("§a".$plugin."§eを読み込みました。§b『製作者 Noi』");

                 $this->saveDefaultConfig();//resourcesにあるconfig.ymlファイルをデータフォルダに入れて保存
                 $this->reloadConfig();//作成されたファイルを再読み込み

                 if(!file_exists($this->getDataFolder())){//configファイルを入れるフォルダがあるかを確認
                     @mkdir($this->getDataFolder(), 0744, true);//なければフォルダを作成
                 }
                 //$this->config変数にConfigオブジェクトを入れておく
                 $this->config = new Config($this->getDataFolder() . "Item_Name.yml", Config::YAML);


          }

          public function getJName($id, $meta){

                 if($meta == null){

                    if($this->config->exists($id)){
                       $name = $this->config->get($id);

                       if(is_array($name)){
                          $name = $name["0"];
                       }

                       if($name == ""){
                          $name = "unknown";
                       }

                    }else{
                       $name = "unknown";

                    }

                 }else{

                    if($this->config->exists($id)){
                       $n = $this->config->get($id);

                       if($this->config->exists($n[$meta])){
                          $name = $n[$meta];

                       }else{
                        $name = "unknown";

                       }
                    }
                 }

                 return $name;
         }


}