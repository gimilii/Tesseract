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
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author iTX Technologies
 * @link https://itxtech.org
 *
 */


namespace pocketmine\entity;

use pocketmine\entity\projectile\ProjectileSource;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\Player;
use pocketmine\network\mcpe\protocol\MobEquipmentPacket;
use pocketmine\item\Item as ItemItem;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\event\entity\EntityShootBowEvent;

class Skeleton extends Monster implements ProjectileSource{
	
	const NETWORK_ID = 34;
	
	public function getName() : string{
		return "Skeleton";
	}
	
	public function initEntity(){
		$this->setMaxHealth(20);
		parent::initEntity();
	}
	
	public function spawnTo(Player $player){
		parent::addEntityPacketAndSpawnTo($player, $this::NETWORK_ID);
		
		$pk = new MobEquipmentPacket();
		$pk->entityRuntimeId = $this->getId();
		$pk->item = new ItemItem(ItemItem::BOW);
		$pk->inventorySlot = 0;
		$pk->hotbarSlot = 0;

		$player->dataPacket($pk);
	}
	
	public function canCatchOnFire() {
		return true;
	}

	
// 	private function launchArrow() {
//         $bow = new ItemItem(262);
// 		$nbt = new CompoundTag("", [
// 				"Pos" => new ListTag("Pos", [
// 						new DoubleTag("", $this->x),
// 						new DoubleTag("", $this->y + $this->getEyeHeight()),
// 						new DoubleTag("", $this->z)
// 				]),
// 				"Motion" => new ListTag("Motion", [
// 						new DoubleTag("", -sin($this->yaw / 180 * M_PI) * cos($this->pitch / 180 * M_PI)),
// 						new DoubleTag("", -sin($this->pitch / 180 * M_PI)),
// 						new DoubleTag("", cos($this->yaw / 180 * M_PI) * cos($this->pitch / 180 * M_PI))
// 				]),
// 				"Rotation" => new ListTag("Rotation", [
// 						new FloatTag("", $this->yaw),
// 						new FloatTag("", $this->pitch)
// 				]),
// 				]);
		
// // 		$diff = ($this->server->getTick() - $this->startAction);
// // 		$p = $diff / 20;
// // 		$f = min((($p ** 2) + $p * 2) / 3, 1) * 2;
// // 		$ev = new EntityShootBowEvent($this, $bow, Entity::createEntity("Arrow", $this->chunk, $nbt, $this, $f == 2 ? true : false), $f);
// 		$ev = new EntityShootBowEvent($this, $bow, Entity::createEntity("Arrow", $this->chunk, $nbt, $this, true), 2);
// // 		if($f < 0.1 or $diff < 5){
// // 			$ev->setCancelled();
// // 		}
		
// 		$this->server->getPluginManager()->callEvent($ev);
		
// 	}
}
