<?php

namespace Refaltor\PestPmmpTests\tests;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use Refaltor\PestPmmpTests\traits\ValidatorTrait;

abstract class PmmpTest
{
    use ValidatorTrait;

    public Player $fakePlayer;

    public function __construct(callable $callback)
    {
        PocketMineTester::createFakePlayer("FAKEPLAYER")->onCompletion(function(Player $player)  use ($callback) {
            $this->fakePlayer = $player;
            (new PlayerJoinEvent(
                $player,
                ""
            ))->call();

            PocketMineTester::getPlugin()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($player, $callback) {
                $callback($this);
            }), 20 * 4); // if sql is charged in player join event
        }, function() {
            PocketmineTester::getPlugin()->getLogger()->error("PocketMineTester fakePlayer creation failed. Retry please.");
            PocketmineTester::getPlugin()->getServer()->shutdown();
        });
    }

    public function getFakePlayer(): Player
    {
        return $this->fakePlayer;
    }

    public function setFakePlayer(Player $fakePlayer): void
    {
        $this->fakePlayer = $fakePlayer;
    }
}