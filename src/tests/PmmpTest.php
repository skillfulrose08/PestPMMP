<?php

namespace Refaltor\PestPmmpTests\tests;

use pocketmine\player\Player;
use Refaltor\PestPmmpTests\traits\ValidatorTrait;

abstract class PmmpTest
{
    use ValidatorTrait;

    public Player $fakePlayer;

    public function __construct()
    {
        PocketMineTester::createFakePlayer("FAKEPLAYER")->onCompletion(function(Player $player) {
            $this->fakePlayer = $player;
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