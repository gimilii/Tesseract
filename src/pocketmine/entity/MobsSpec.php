<?php

namespace pocketmine\entity;

class MobsSpec {
	public $mobSpec = [];
	
	public function __construct(Server $server) {
		$this->mobSpec->["Zombie"] = array (
				'ID' => $mobEntity->getId (),
				'IsChasing' => false,
				'time' => 10,
				'x' => $mobEntity->getX (),
				'y' => $mobEntity->getY (),
				'z' => $mobEntity->getZ (),
				'canAttack' => 0,
				'yaw' => $mobEntity->yaw,
				'pitch' => $mobEntity->pitch,
				'explodeCount' => 0
		);
	}
}