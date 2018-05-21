<?php
namespace SP_Zonbieef;

use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{

	function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	function onPlayerEat(PlayerItemConsumeEvent $event){

		$player = $event->getPlayer();
		$name = $player->getName();
		$item = $player->getInventory()->getItemInHand()->getId();

		if($item === 260){

			for($num = 1; $num < 24; $num++){

				$effect = new EffectInstance(Effect::getEffect($num));//effectID
				$effect->setDuration(120*20);//効果の時間*20
				$effect->setAmplifier(2);//効果の強さ
				$effect->setVisible(true);//パーティクルを表示するかどうか
				$player->addEffect($effect);

			}

			$player->sendMessage("全てのエフェクトを我が力に・・・");
		}
	}

}
