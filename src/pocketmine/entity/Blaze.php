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

use pocketmine\Player;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item as ItemItem;

class Blaze extends Monster{
	const NETWORK_ID = 43;

	public function initEntity(){
		$this->width = 0.3;
		$this->length = 0.9;
		parent::initEntity();
	}
	
	public function getName() : string{
		return "Blaze";
	}

	public function getDrops(){
		$cause = $this->lastDamageCause;
		//Only drop when kill by player or dog(No add now.)
		if($cause instanceof EntityDamageByEntityEvent and $cause->getDamager() instanceof Player){
			$lootingL = 0;
			$drops = array(ItemItem::get(ItemItem::BLAZE_ROD, 0, mt_rand(0, 1 + $lootingL)));
			return $drops;
		}
		return [];
	}
}
