<?php

namespace booqtecca\TpUI\subcommand;

use InvalidStateException;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use booqtecca\TpUI\Loader;

class ListSubCommand extends SubCommand
{
    /**
     * @param CommandSender $sender
     * @return bool
     * @throws InvalidStateException
     */
    public function canUse(CommandSender $sender): bool
    {
        return ($sender instanceof Player) and $sender->hasPermission('TpUI.command.warp.list');
    }

    public function getUsage(): string
    {
        return 'list';
    }

    public function getName(): string
    {
        return 'list';
    }

    public function getDescription(): string
    {
        return 'Listing all warp names';
    }

    public function getAliases(): array
    {
        return [];
    }

    /**
     * @param CommandSender $sender
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, array $args): bool
    {
        $sender->sendMessage(TextFormat::AQUA . "Warpnames:\n" . implode("\n" . TextFormat::GOLD, Loader::getWarps()));
        return true;
    }
}
