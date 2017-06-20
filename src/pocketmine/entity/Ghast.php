<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\entity;

use pocketmine\block\Air;
use pocketmine\block\Obsidian;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\event\entity\EntityDamageEvent;

class Ghast extends Monster {
	
	const NETWORK_ID = 41;
	private $oldHealth = 0;
	
	public function getName() : string{
		return "Ghast";
	}

	public function initEntity(){
		$this->width = 6;
		$this->length = 6;
		$this->height = 6;
		parent::initEntity();
		$this->setMaxHealth(1000);
		$this->setHealth(1000);
		$block = new Obsidian();
		$level = $this->getLevel();
		$this->getLevel()->setBlock(new Vector3(168, 71, 257), $block);
		$this->getLevel()->setBlock(new Vector3(168, 72, 257), $block);
		$this->setAIControl(false);
	}
	
	public function kill(){
		$block = new Air();
		$this->getLevel()->setBlock(new Vector3(168, 71, 257), $block);
		$this->getLevel()->setBlock(new Vector3(168, 72, 257), $block);
		parent::kill();
	}
	
	public function attack(EntityDamageEvent $source){
		parent::attack($source);
		$h = $this->getHealth();
		print "h: $h \n";
		if ($h % 50 == 0 && $h != $this->oldHealth) {
			$this->oldHealth = $h;
			print "Ghast health remaining: $h \n";
		}
	}

}
