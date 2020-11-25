<?php
  
namespace Mentagess\Seed;

use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\utils\Config;
use pocketmine\block\Block;

class Main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$config = new Config($this->getDataFolder(). "config.yml", Config::YAML);
 }

	public function onBreak(BlockBreakEvent $event) {
    $config = new Config($this->getDataFolder() . "config.yml");
		$block = $event->getBlock();
    $player = $event->getPlayer();
 
if (($block->getID() === $config->get("id")) && ($block->getDamage() === $config->get("meta"))) {
if($event->isCancelled()) return;
        $num = rand(0,$config->get("chance-max")); 
        if($num >= 0 && $num <= $config->get("chance-1")){
          $event->setDrops([Item::get($config->get("item-drop-1"),$config->get("meta-drop-1"),$config->get("nb-drop-1"))]);
          $player->sendTip($config->get("tip-drop-1"));
        }    
        if($num >= $config->get("chance-1") + 1 && $num <= $config->get("chance-max")){
          $event->setDrops([Item::get($config->get("item-drop-2"),$config->get("meta-drop-2"),$config->get("nb-drop-2"))]);
          $player->sendTip($config->get("tip-drop-2"));
        } 
    }
  }
}
