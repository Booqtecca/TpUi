<?php

namespace booqtecca\TpUI\subcommand;

use InvalidStateException;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use booqtecca\TpUI\Loader;

class AddSubCommand extends SubCommand
{

    /**
     * @param CommandSender $sender
     * @return bool
     * @throws InvalidStateException
     */
    public function canUse(CommandSender $sender): bool
    {
        return ($sender instanceof Player) and $sender->hasPermission('TpUI.command.warp.add');
    }

    public function getUsage(): string
    {
        return 'add <name>';
    }

    public function getName(): string
    {
        return 'add';
    }

    public function getDescription(): string
    {
        return 'Add a warp point';
    }

    public function getAliases(): array
    {
        return [];
    }

    /**
     * @param CommandSender $sender
     * @param array $args
     * @return bool
     * @throws InvalidStateException
     */
    public function execute(CommandSender $sender, array $args): bool
    {
        if (empty($args)) {
            return false;
        }
        $name = implode(' ', $args);
        /** @var Player $sender */
        $location = $sender->getLocation();
        if (Loader::addWarp($location, $name)) {
            $sender->sendMessage(TextFormat::GREEN . 'Added ' . $name . ' at ' . $location . ' to the warp item');
            return true;
        }

        return false;
    }
}
