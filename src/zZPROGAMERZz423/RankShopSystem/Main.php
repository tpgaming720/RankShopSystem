<?php

namespace Mardy\warpui;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{

    public function onEnable(){
    	$this->getLogger()->info("Loaded warpui");
    }

    public function onDisable(){
    	$this->getLogger()->info("Loaded warpui");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {

        switch($cmd->getName()){
        	case "warp":
        	case "go":
        	    if($sender instanceof Player){
        	    	$this->Form($sender);
        	    }
            }   
        return true;
    }

    public function Form($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if($result == null){
                return true;
            }
            switch($result){
                case 0:
                    $sender->sendMessage("§cCanceled your request");
                break;
                
                case 1:
                    $command = "cavewarp plot";
                    $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;

                case 2:
                    $command = "cavewarp shop";
                    $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;

                case 3:
                    $command = "cacewarp mine";
                    $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;
                
                case 4:
                    $command = "cavewarp pvpmine";
                    $this->getServer()->getCommandMap()->dispatch($sender, $command);
                break;
            }
        });
        $form->setTitle("§l§bTheCave");
        $form->setContent("§fClick on what you want to go");
        $form->addButton("§cExist");
        $form->addButton("§f§r§6PLOT§f§r\n§eClick To Teleport");
        $form->addButton("§f§r§6SHOP§r\n§eClick To Teleport");
        $form->addButton("§f§r§6MINE§f§r\n§eClick To Teleport");
        $form->addButton("§f§r§6PVPMINE§f§r\n§eClick To Teleport");
        $form->sendToPlayer($player);
        return $form;
    }
    
}
