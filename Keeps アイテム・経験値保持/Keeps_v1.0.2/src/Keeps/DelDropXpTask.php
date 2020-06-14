<?php

namespace keeps;

use pocketmine\scheduler\Task;
use pocketmine\entity\object\ExperienceOrb;

class DelDropXpTask extends Task {

	public function __construct(Main $owner, $AxisAlignedBB, $level) {

		$this->owner = $owner;
		$this->AxisAlignedBB = $AxisAlignedBB;
		$this->level = $level;

	}


	public function onRun(int $currentTick) {

		$entities = $this->level->getNearByEntities($this->AxisAlignedBB);

		foreach($entities as $entity) {
			if($entity instanceof ExperienceOrb) {
				$entity->kill();
			}
		}

	}

}