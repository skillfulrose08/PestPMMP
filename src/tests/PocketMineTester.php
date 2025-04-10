<?php

namespace Refaltor\PestPmmpTests\tests;

use muqsit\fakeplayer\FakePlayer;
use muqsit\fakeplayer\Loader;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

class PocketMineTester
{
    private static PluginBase $plugin;

    public static function initPlugin(PluginBase $plugin): void
    {
        self::setPlugin($plugin);

        $pluginsLoaded = $plugin->getServer()->getPluginManager()->loadPlugins(__DIR__ . "../../resources/fakeplayer.phar");
        if (count($pluginsLoaded) <= 0) {
            $plugin->getLogger()->error("Fake Player plugin not loaded. Please check PestPMMP installation.");
            $plugin->getServer()->shutdown();
        }
    }

    public static function getPlugin(): PluginBase
    {
        return self::$plugin;
    }

    private static function setPlugin(PluginBase $plugin): void
    {
        self::$plugin = $plugin;
    }

    public static function createFakePlayer(): void
    {

    }
}