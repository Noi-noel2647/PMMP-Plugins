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
		$this->getLogger()->info("§a".$plugin."§eis loaded. §f何かあれば§bTwitter §e@Noi_noel2647 §fまで");


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

		if($entity instanceof Player){

			if($this->cause["ALL"] === true){
				$event->setCancelled();

			}else{

				switch($event->getCause()){

					case $event::CAUSE_CONTACT:
						if($this->cause["CAUSE_CONTACT"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_ENTITY_ATTACK:
						if($this->cause["CAUSE_ENTITY_ATTACK"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_PROJECTILE:
						if($this->cause["CAUSE_PROJECTILE"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_SUFFOCATION:
						if($this->cause["CAUSE_SUFFOCATION"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_FALL:
						if($this->cause["CAUSE_FALL"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_FIRE:
						if($this->cause["CAUSE_FIRE"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_FIRE_TICK:
						if($this->cause["CAUSE_FIRE_TICK"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_LAVA:
						if($this->cause["CAUSE_LAVA"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_DROWNING:
						if($this->cause["CAUSE_DROWNING"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_BLOCK_EXPLOSION:
						if($this->cause["CAUSE_BLOCK_EXPLOSION"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_ENTITY_EXPLOSION:
						if($this->cause["CAUSE_ENTITY_EXPLOSION"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_VOID:
						if($this->cause["CAUSE_VOID"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_SUICIDE:
						if($this->cause["CAUSE_SUICIDE"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_MAGIC:
						if($this->cause["CAUSE_MAGIC"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_CUSTOM:
						if($this->cause["CAUSE_CUSTOM"] === true){
							$event->setCancelled();

						}
						break;

					case $event::CAUSE_STARVATION:
						if($this->cause["CAUSE_STARVATION"] === true){
							$event->setCancelled();

						}
						break;

				}
			}
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