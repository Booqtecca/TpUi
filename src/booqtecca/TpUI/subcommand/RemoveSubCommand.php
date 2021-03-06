<?php

namespace booqtecca\TpUI\subcommand;

use InvalidArgumentException;
use InvalidStateException;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use booqtecca\customui\elements\Button;
use booqtecca\customui\windows\SimpleForm;
use booqtecca\TpUI\Loader;

class RemoveSubCommand extends SubCommand
{

    /**
     * @param CommandSender $sender
     * @return bool
     * @throws InvalidStateException
     */
    public function canUse(CommandSender $sender): bool
    {
        return ($sender instanceof Player) and $sender->hasPermission('TpUI.command.warp.remove');
    }

    public function getUsage(): string
    {
        return 'remove';
    }

    public function getName(): string
    {
        return 'remove';
    }

    public function getDescription(): string
    {
        return 'Remove a warp';
    }

    public function getAliases(): array
    {
        return [];
    }

    /**
     * @param CommandSender $sender
     * @param array $args
     * @return bool
     * @throws InvalidArgumentException
     */
    public function execute(CommandSender $sender, array $args): bool
    {
        /** @var Player $sender */
        $form = new SimpleForm(TextFormat::DARK_RED . 'Remove warps', 'Click a warp to remove it');
        foreach (Loader::getWarps() as $warp) {
            $form->addButton(new Button($warp));
        }
        $form->setCallable(static function (Player $player, $data) {
            if (Loader::removeWarp($data)) {
                $player->sendMessage(TextFormat::GREEN . 'Removed ' . $data . TextFormat::RESET . TextFormat::GREEN . ' from the warp item');
            } else {
                $player->sendMessage(TextFormat::RED . 'Incorrect warp name');
            }
        }
        );
        $sender->sendForm($form);
        return true;
    }
}
