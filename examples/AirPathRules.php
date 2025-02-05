<?php

declare(strict_types=1);

use matze\pathfinder\setting\rule\PathRules;
use matze\pathfinder\result\PathResult;
use matze\pathfinder\setting\Settings;
use matze\pathfinder\type\AsyncPathfinder;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\block\Liquid;
use pocketmine\math\Vector3;
use pocketmine\Server;

class AirPathRules extends PathRules {
    public function isBlockSolid(Block $block): bool {
        return $block instanceof Air;
    }

    public function isBlockPassable(Block $block): bool {
        return count($block->getCollisionBoxes()) <= 0 && !$block instanceof Liquid;
    }

    public function getCostInside(Block $block): int {
        return 0;
    }

    public function getCostStanding(Block $block): int {
        return 0;
    }
}

// How to use
$pathfinder = new AsyncPathfinder(Settings::get()->setPathRules(new UnderwaterPathRules()), Server::getInstance()->getWorldManager()->getDefaultWorld());
$pathfinder->findPath(new Vector3(0, 100, 0), new Vector3(10, 100, 0), function (?PathResult $result): void {
    echo "I believe I can fly!";
});