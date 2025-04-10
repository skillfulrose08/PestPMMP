<?php

namespace Refaltor\PestPmmpTests\tests;

use pocketmine\player\Player;
use Refaltor\PestPmmpTests\traits\ValidatorTrait;

abstract class PmmpTest
{
    use ValidatorTrait;

    public ?Player $fakePlayer = null;

    public function __construct()
    {
        PocketMineTester::createFakePlayer("FAKEPLAYER")->onCompletion(function(Player $player) {
            $this->fakePlayer = $player;
        }, function() {});
    }
}