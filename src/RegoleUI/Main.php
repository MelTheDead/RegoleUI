<?php

namespace RegoleUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("Enable V1.0...");
                $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§4Per favore metti FormAPI nella cartella plugins. disattivato RulesUi...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "regole":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§7Fai il comando in-game");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                        break;
            }
        });
        $form->setTitle("§l§cRegole");
        $form->setContent("§l§41. §cNon Usare Hack \n §42. §cNo 2v1 \n §43. §cNo Team In PvP \n §44. §cNo Bugabusate \n\n §rBy Plugin ItzIKen");
        $form->addButton("§4Chiudi", 0);
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("RegoleUI V1.0 Disattivato!");
    }
}
