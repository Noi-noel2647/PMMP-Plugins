<?php

namespace NoiPluginLoader;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;


class Main extends PluginBase {



	public function onEnable(){

		$this->getLogger()->info(TextFormat::LIGHT_PURPLE. "Noi's Plugins Loading. -Noiさんのプラグインを読み込んでいます-");
		$path = $this->getDataFolder();

		if(!file_exists($path)){
			 mkdir($path, 0744, true);

		}

		$this->onPluginLoad($path);

		$this->config = new Config($path . "config.yml", Config::YAML);


	}


	public function onDisble(){

	}


	public function onPluginLoad($path){

		$plugins = $this->getServer()->getPluginManager()->loadPlugins($path);
		$count = count($plugins);
		$ecount = 0;
		$LoadPlugins = "";
		$disbles = [];

		foreach($plugins as $plugin){

		/*--------Noiプラグイン以外を省く処理--------*/

			$authors = $plugin->getDescription()->getAuthors();
			$name = $plugin->getName();

			if(!in_array("Noi", $authors)){
				$file = $plugin->getFile();
				$file = str_replace('phar://', '', $file);
				$file = substr($file, 0, -1); 
				unlink($file);
				$disbles[] = $name;

			}

		/*--------プラグインを有効化/無効化する処理--------*/

			if(!in_array($name, $disbles)){
				$this->getServer()->getPluginManager()->enablePlugin($plugin);
				$ecount++;

			}

		/*--------プラグイン一覧を表示する処理--------*/

			if(strlen($LoadPlugins) > 0){
				$LoadPlugins .= TextFormat::WHITE . ", ";

			}
			$LoadPlugins .= $plugin->isEnabled() ? TextFormat::GREEN : TextFormat::RED;
			$LoadPlugins .= $plugin->getDescription()->getFullName();

		}

		$this->getLogger()->info($LoadPlugins);
		$this->getLogger()->info($ecount."/".$count." のプラグインが読み込まれました。");
		$this->getLogger()->notice(TextFormat::AQUA. "Twitter: ".TextFormat::YELLOW."https://twitter.com/Noi_noel2647");
		$this->getLogger()->notice(TextFormat::BLUE. "GitHub: ".TextFormat::YELLOW."https://github.com/shoki-3738");

	}
}


