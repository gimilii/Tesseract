<?php

/*
 *
 *  _____   _____   __   _   _   _____  __    __  _____
 * /  ___| | ____| |  \ | | | | /  ___/ \ \  / / /  ___/
 * | |     | |__   |   \| | | | | |___   \ \/ /  | |___
 * | |  _  |  __|  | |\   | | | \___  \   \  /   \___  \
 * | |_| | | |___  | | \  | | |  ___| |   / /     ___| |
 * \_____/ |_____| |_|  \_| |_| /_____/  /_/     /_____/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author iTX Technologies
 * @link https://itxtech.org
 *
 */

namespace pocketmine\entity;

use pocketmine\item\Item as ItemItem;

class Cow extends Animal{
	const NETWORK_ID = 11;
	
	public function initEntity(){
		$this->width = 0.3;
		$this->length = 0.9;
		parent::initEntity();
	}
	
	public function getName() : string{
		return "Cow";
	}
	
	public function getDrops(){
		$lootingL = 0;
		$cause = $this->lastDamageCause;
// 		if($cause instanceof EntityDamageByEntityEvent and $cause->getDamager() instanceof Player){
// 			$lootingL = $cause->getDamager()->getItemInHand()->getEnchantmentLevel(Enchantment::TYPE_WEAPON_LOOTING);
// 		}
		$drops = array(ItemItem::get(ItemItem::RAW_BEEF, 0, mt_rand(1, 3 + $lootingL)));
		$drops[] = ItemItem::get(ItemItem::LEATHER, 0, mt_rand(0, 2 + $lootingL));
		//TODO: add judgement for Steak
		/*if ($this->lastDamageCause instanceof EntityDamageByEntityEvent and $this->lastDamageCause->getEntity() instanceof Player) {
			$drops[] = ItemItem::get(ItemItem::LEATHER, 0, mt_rand(0,2));
		}*/
		return $drops;
	}
}
