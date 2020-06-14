<?php
namespace FloatingInfo;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\SetActorDataPacket;


class UpdataTask extends Task {


	public function __construct(PluginBase $owner, $eid) {

		$this->owner = $owner;
		$this->eid = $eid;
		$this->server = $this->owner->getServer();

	}


	public function onRun(int $Tick) {
		$this->newInfo($this->eid);

	}


	/*----------------------API----------------------*/

	public function newInfo($eid) {

		$text = $this->getNewText();
		$players = $this->server->getOnlinePlayers();

		$pk = new SetActorDataPacket();

			$pk->entityRuntimeId = $eid;
			$pk->metadata = [
						Entity::DATA_NAMETAG => [Entity::DATA_TYPE_STRING, $text]
					];



		foreach($players as $player){

			$player->dataPacket($pk);

		}
    }


	public function getNewText(){

		$maxps = $this->server->getMaxPlayers();				//サーバーの可能な最大参加人数
		$players = $this->server->getOnlinePlayers();
		$online = count($players);						//オンラインプレイヤーの人数

		$plugins = count($this->server->getPluginManager()->getPlugins());	//プラグインの数
		$time = date('n月 d日 G:i:s');						//現在の時刻
		$week = array( "日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日" );

		$ot = $this->getUpTime();						//server稼働時間の取得

		$text = "    §l§e===== §bSERVER INFO §e===== \n".
			"    §6◆ §bサーバーの接続人数 ：§f {$online}/{$maxps}人 \n".
			"    §6◆ §2現在時刻 ：§f {$time} {$week[date("w")]} \n".
			"    §6◆ §6導入プラグインの数 ：§f {$plugins} \n".
			"    §6◆ §3Server稼働時間 ：§f {$ot} \n";

		return $text;

	}


	public function getUpTime(){

		$time = microtime(true) - \pocketmine\START_TIME;

		$seconds = floor($time % 60);
		$minutes = null;
		$hours = null;
		$days = null;

		if($time >= 60){
			$minutes = floor(($time % 3600) / 60);
			if($time >= 3600){
				$hours = floor(($time % (3600 * 24)) / 3600);
				if($time >= 3600 * 24){
					$days = floor($time / (3600 * 24));
				}
			}
		}

		$uptime = ($minutes !== null ?
				($hours !== null ?
					($days !== null ?
						"$days 日 "
					: "") . "$hours 時間 "
				: "") . "$minutes 分 "
			: "") . "$seconds 秒";



		return $uptime;
	}


}
