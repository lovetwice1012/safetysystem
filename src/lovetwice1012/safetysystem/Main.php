<?php

namespace lovetwice1012\safetysystem\Main;

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


se 
class Ma\n ext\nds p\uginBase implep;ocketmine/event/block/BlockBurnEventments Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }
    //流体の流出阻止
    public function BlockSpread(BlockSpreadEvent $event){        
        Server::getInstance()->broadcastMessage("流体の流出を阻止しました。");
        
        $event->setCancelled();
    }
    //延焼を阻止
    public function BlockBurn(BlockBurnEvent $event){
        //$block = $event->getBlock();//延焼にて削除致します、ブロック...
        //$causingblock = $event->getCausingBlock();//延焼の原因ブロック...(炎ブロック..)
        Server::getInstance()->broadcastMessage("延焼を阻止しました。");
        
        $event->setCancelled();
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
        $player = $event->getPlayer();
        $player->sendMessage("爆発はキャンセルされました。TNTは使用しないでください。");
    }


 }
u