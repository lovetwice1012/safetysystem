<?php

namespace lovetwice1012\safetysystem;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Server;
use pocketmine\block\Block;
use pocketmine\event\block\{BlockBreakEvent, BlockPlaceEvent};
use pocketmine\utils\Config;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\form\Form;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\block\BlockBurnEventments;
use pocketmine\block\BlockFactory;
use pocketmine\block\Lava;
use pocketmine\block\Water;
use pocketmine\block\Fire;
use pocketmine\block\Ice;

class Main extends pluginBase implements Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        //水の流出阻止        
	BlockFactory::registerBlock(new class () extends Water {
            public function onScheduledUpdate(): void
            {
                    //Stop
            }
        }, true);
	//氷を解けなくする1
	BlockFactory::registerBlock(new class () extends Ice {
	    public function onBreak(Item $item, Player $player = null) : bool{
		//don't do enything when Ice break with silktouch
		return parent::onBreak($item, $player);
	    }
	}, true);
	//氷を解けなくする2
	BlockFactory::registerBlock(new class () extends Ice {
	    public function onRandomTick() : void{
		//stop
	    }
	}, true);
	//溶岩の流出阻止
	BlockFactory::registerBlock(new class() extends Lava {
            public function onScheduledUpdate(): void
            {
                //Stop
            }
        }, true);
        //炎の延焼阻止
	BlockFactory::registerBlock(new class() extends Fire {
            public function onScheduledUpdate(): void
            {
                //Stop
            }
        }, true);
    }
	
///落下ダメージ無効化
    public function EntityDamage(EntityDamageEvent $event)
	{
		if($event->getCause() === EntityDamageEvent::CAUSE_FALL)
		{
			$event->setCancelled();
		}

    }

///TNT爆発キャンセル
	
    public function onExplode(EntityExplodeEvent $event)
    {
        $event->setCancelled();
    }
	
 }
