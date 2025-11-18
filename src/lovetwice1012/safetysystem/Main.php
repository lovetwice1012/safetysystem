<?php

namespace lovetwice1012\safetysystem;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\block\BlockFactory;
use pocketmine\block\Lava;
use pocketmine\block\Water;
use pocketmine\block\Fire;
use pocketmine\block\Ice;

class Main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        // 水の流出阻止
        BlockFactory::registerBlock(new class () extends Water {
            public function onScheduledUpdate(): void
            {
                // Stop
            }
        }, true);

        // 氷を解けなくする1
        BlockFactory::registerBlock(new class () extends Ice {
            public function onBreak(Item $item, Player $player = null) : bool{
                // don't do anything when Ice break with silktouch
                return parent::onBreak($item, $player);
            }
        }, true);

        // 氷を解けなくする2
        BlockFactory::registerBlock(new class () extends Ice {
            public function onRandomTick() : void{
                // stop
            }
        }, true);

        // 溶岩の流出阻止
        BlockFactory::registerBlock(new class() extends Lava {
            public function onScheduledUpdate(): void
            {
                // Stop
            }
        }, true);

        // 炎の延焼阻止
        BlockFactory::registerBlock(new class() extends Fire {
            public function onScheduledUpdate(): void
            {
                // Stop
            }
        }, true);
    }

    // 落下ダメージ無効化
    public function EntityDamage(EntityDamageEvent $event)
    {
        if($event->getCause() === EntityDamageEvent::CAUSE_FALL)
        {
            $event->setCancelled();
        }
    }

    // TNT爆発キャンセル
    public function onExplode(EntityExplodeEvent $event)
    {
        $event->setCancelled();
    }
}
