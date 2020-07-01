<?php
namespace SP_Zonbieef;

use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;


class Main extends PluginBase implements Listener {

	function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

	}

	function onPlayerEat(PlayerItemConsumeEvent $event) {

		$player = $event->getPlayer();
		$item = $event->getItem()->getId();

		if($item === 367) {	//アイテムIDがゾンビ肉(367)だったら

			$bad_effects = array(2, 4, 7, 9, 15, 17, 18, 19, 20, 24, 25);

			for($num = 1; $num < 26; $num++) {
				if(!in_array($num, $bad_effects)) {

					$effect = new EffectInstance(Effect::getEffect($num));//effectID
					$effect->setDuration(120*20);//効果の時間*20
					$effect->setAmplifier(4);//効果の強さ
					$effect->setVisible(true);//パーティクルを表示するかどうか
					$player->addEffect($effect);

				}
			}

			$player->addTitle("§a 全ての力を我がものに・・・", "力こそＰＯＷＥＲ", 20, 60, 20);
		}
	}

}
