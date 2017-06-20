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

use pocketmine\network\mcpe\protocol\MobEquipmentPacket;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;
use pocketmine\item\Item as ItemItem;
use pocketmine\item\enchantment\Enchantment;

class PigZombie extends Monster{
	const NETWORK_ID = 36;

	public $drag = 0.2;
	public $gravity = 0.3;
	
	public function initEntity(){
		$this->width = 0.6;
		$this->length = 0.6;
		$this->height = 1.8;
		parent::initEntity();
	}
	
	public function getName() : string{
		return "PigZombie";
	}
	
	public function spawnTo(Player $player){
		parent::addEntityPacketAndSpawnTo($player, PigZombie::NETWORK_ID);
		
		$pk = new MobEquipmentPacket();
		$pk->eid = $this->getId();
		$pk->item = new ItemItem(283);
		$pk->slot = 0;
		$pk->selectedSlot = 0;

		$player->dataPacket($pk);
	}

	public function getDrops(){
		$cause = $this->lastDamageCause;
		$drops = [];
		if($cause instanceof EntityDamageByEntityEvent and $cause->getDamager() instanceof Player){
// 			$lootingL = $cause->getDamager()->getItemInHand()->getEnchantmentLevel(Enchantment::TYPE_WEAPON_LOOTING);
			$lootingL = 0;
			if(mt_rand(1, 200) <= (5 + 2 * $lootingL)){
				$drops[] = ItemItem::get(ItemItem::GOLD_INGOT, 0, 1);
			}
			$drops[] = ItemItem::get(ItemItem::GOLD_NUGGET, 0, mt_rand(0, 1 + $lootingL));
			$drops[] = ItemItem::get(ItemItem::ROTTEN_FLESH, 0, mt_rand(0, 1 + $lootingL));
		}
		return $drops;
	}
}
