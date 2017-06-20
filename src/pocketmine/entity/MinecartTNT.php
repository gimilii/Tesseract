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

use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\Player;

class MinecartTNT extends Minecart{
	const NETWORK_ID = 97;

	public function getName() : string{
		return "Minecart TNT";
	}

	public function getType() : int{
		return self::TYPE_TNT;
	}

	public function spawnTo(Player $player){
		parent::addEntityPacketAndSpawnTo($player, MinecartTNT::NETWORK_ID);
	}
}
