<?php

namespace DamageManager;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;


class Main extends PluginBase implements Listener {



	public function onEnable(){

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$plugin = "DamageManager";
		$this->getLogger()->notice("§a".$plugin." §3is loaded. §7(Dev. Noi)");
		$this->getLogger()->notice("§bTwitter §e@Noi_noel2647");
		$this->getLogger()->notice("§9GitHub §ehttps://github.com/shoki-3738");


		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);

		}

		$config = new Config($this->getDataFolder() . "config.yml", Config::YAML,

					[
						"ALL" => false,
						"CAUSE_CONTACT" => false,
						"CAUSE_ENTITY_ATTACK" => false,
						"CAUSE_PROJECTILE" => false,
						"CAUSE_SUFFOCATION" => false,
						"CAUSE_FALL" => false,
						"CAUSE_FIRE" => false,
						"CAUSE_FIRE_TICK" => false,
						"CAUSE_LAVA" => false,
						"CAUSE_DROWNING" => false,
						"CAUSE_BLOCK_EXPLOSION" => false,
						"CAUSE_ENTITY_EXPLOSION" => false,
						"CAUSE_VOID" => false,
						"CAUSE_SUICIDE" => false,
						"CAUSE_MAGIC" => false,
						"CAUSE_CUSTOM" => false,
						"CAUSE_STARVATION" => false,

					]
				);

		$this->cause = $config->getAll();

	}


	public function onDamage(EntityDamageEvent $event){

		$entity = $event->getEntity();
		$cause = $this->getCauseString($event->getCause());

		if($entity instanceof Player){

			if($this->cause["ALL"] === true){
				$event->setCancelled();

			}elseif($this->cause[$cause] === true){
				$event->setCancelled();

			}
		}
	}


	public function getCauseString($cause) {

		switch($cause){

			case 0:
				return "CAUSE_CONTACT";
			case 1:
				return "CAUSE_ENTITY_ATTACK";
			case 2:
				return "CAUSE_PROJECTILE";
			case 3:
				return "CAUSE_SUFFOCATION";
			case 4:
				return "CAUSE_FALL";
			case 5:
				return "CAUSE_FIRE";
			case 6:
				return "CAUSE_FIRE_TICK";
			case 7:
				return "CAUSE_LAVA";
			case 8:
				return "CAUSE_DROWNING";
			case 9:
				return "CAUSE_BLOCK_EXPLOSION";
			case 10:
				return "CAUSE_ENTITY_EXPLOSION";
			case 11:
				return "CAUSE_VOID";
			case 12:
				return "CAUSE_SUICIDE";
			case 13:
				return "CAUSE_MAGIC";
			case 14:
				return "CAUSE_CUSTOM";
			case 15:
				return "CAUSE_STARVATION";

		}
	}





	/*switch($cause === null ? EntityDamageEvent::CAUSE_CUSTOM : $cause->getCause()){
			case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
				if($cause instanceof EntityDamageByEntityEvent){
					$e = $cause->getDamager();
					if($e instanceof Player){
						$message = "death.attack.player";
						$params[] = $e->getDisplayName();
						break;
					}elseif($e instanceof Living){
						$message = "death.attack.mob";
						$params[] = $e->getNameTag() !== "" ? $e->getNameTag() : $e->getName();
						break;
					}else{
						$params[] = "Unknown";
					}
				}
				break;
			case EntityDamageEvent::CAUSE_PROJECTILE:
				if($cause instanceof EntityDamageByEntityEvent){
					$e = $cause->getDamager();
					if($e instanceof Player){
						$message = "death.attack.arrow";
						$params[] = $e->getDisplayName();
					}elseif($e instanceof Living){
						$message = "death.attack.arrow";
						$params[] = $e->getNameTag() !== "" ? $e->getNameTag() : $e->getName();
						break;
					}else{
						$params[] = "Unknown";
					}
				}
				break;
			case EntityDamageEvent::CAUSE_SUICIDE:
				$message = "death.attack.generic";
				break;
			case EntityDamageEvent::CAUSE_VOID:
				$message = "death.attack.outOfWorld";
				break;
			case EntityDamageEvent::CAUSE_FALL:
				if($cause instanceof EntityDamageEvent){
					if($cause->getFinalDamage() > 2){
						$message = "death.fell.accident.generic";
						break;
					}
				}
				$message = "death.attack.fall";
				break;

			case EntityDamageEvent::CAUSE_SUFFOCATION:
				$message = "death.attack.inWall";
				break;

			case EntityDamageEvent::CAUSE_LAVA:
				$message = "death.attack.lava";
				break;

			case EntityDamageEvent::CAUSE_FIRE:
				$message = "death.attack.onFire";
				break;

			case EntityDamageEvent::CAUSE_FIRE_TICK:
				$message = "death.attack.inFire";
				break;

			case EntityDamageEvent::CAUSE_DROWNING:
				$message = "death.attack.drown";
				break;

			case EntityDamageEvent::CAUSE_CONTACT:
				if($cause instanceof EntityDamageByBlockEvent){
					if($cause->getDamager()->getId() === Block::CACTUS){
						$message = "death.attack.cactus";
					}
				}
				break;

			case EntityDamageEvent::CAUSE_BLOCK_EXPLOSION:
			case EntityDamageEvent::CAUSE_ENTITY_EXPLOSION:
				if($cause instanceof EntityDamageByEntityEvent){
					$e = $cause->getDamager();
					if($e instanceof Player){
						$message = "death.attack.explosion.player";
						$params[] = $e->getDisplayName();
					}elseif($e instanceof Living){
						$message = "death.attack.explosion.player";
						$params[] = $e->getNameTag() !== "" ? $e->getNameTag() : $e->getName();
						break;
					}
				}else{
					$message = "death.attack.explosion";
				}
				break;

			case EntityDamageEvent::CAUSE_MAGIC:
				$message = "death.attack.magic";
				break;

			case EntityDamageEvent::CAUSE_CUSTOM:
				break;

			default:
				break;
		}*/

}