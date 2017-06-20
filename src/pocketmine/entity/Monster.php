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

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item as ItemItem;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageEvent;

abstract class Monster extends Mob {
	
	public function attack(EntityDamageEvent $source){
		parent::attack($source);
	
		if($source instanceof EntityDamageByEntityEvent){
			$e = $source->getDamager();
			if ($e != null) {	
				$deltaX = $this->x - $e->x;
				$deltaZ = $this->z - $e->z;
				$this->knockBack($e, $source->getDamage(), $deltaX / 100, $deltaZ / 100, $source->getKnockBack());
			}
		}
	}
	
	public function getDrops(){
		$lootingL = 0;
		$cause = $this->lastDamageCause;
		$drops = [];
		if($cause instanceof EntityDamageByEntityEvent and $cause->getDamager() instanceof Player){
			if(mt_rand(0, 199) < (5 + 2 * $lootingL)){
				switch(mt_rand(0, 3)){
					case 0:
						$drops[] = ItemItem::get(ItemItem::IRON_INGOT, 0, 1);
						break;
					case 1:
						$drops[] = ItemItem::get(ItemItem::CARROT, 0, 1);
						break;
					case 2:
						$drops[] = ItemItem::get(ItemItem::POTATO, 0, 1);
						break;
				}
			}
			$count = mt_rand(0, 2 + $lootingL);
			if($count > 0){
				$drops[] = ItemItem::get(ItemItem::ROTTEN_FLESH, 0, $count);
			}
		}
	
		return $drops;
	}
	
	public function getHateRadius() {
		return 5;
	}
}
