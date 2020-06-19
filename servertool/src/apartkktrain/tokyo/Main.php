<?php

namespace apartkktrain\tokyo\Main;

///まちがえ防止のためuse文は余分に書いてます...ごめんなさい...
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
///今回使用するイベント
use pocketmine\event\entity\EntityExplodeEvent;



class Main extends pluginBase implements Listener
{
    public function onEnable()
    {
        $this->getLogger()->notice("----------------------");
        $this->getLogger()->notice("serverTool構築完了。");
        $this->getLogger()->notice("----------------------");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

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