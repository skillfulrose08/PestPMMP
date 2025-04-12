<?php

namespace Refaltor\PestPmmpTests\tests;

use muqsit\fakeplayer\info\FakePlayerInfoBuilder;
use muqsit\fakeplayer\Loader;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\promise\Promise;
use Ramsey\Uuid\Uuid;

class PocketMineTester
{
    private static PluginBase $plugin;

    public static function initPlugin(PluginBase $plugin): void
    {
        self::setPlugin($plugin);

        $pluginsLoaded = $plugin->getServer()->getPluginManager()->loadPlugins(__DIR__ . "/../../resources/fakeplayer.phar");
        if (count($pluginsLoaded) <= 0) {
            $plugin->getLogger()->error("Fake Player plugin not loaded. Please check PestPMMP installation.");
            $plugin->getServer()->shutdown();
        }
    }

    private static function getFakePlayerPlugin(): Plugin|Loader
    {
        return self::getPlugin()->getServer()->getPluginManager()->getPlugin("FakePlayer");
    }

    public static function getPlugin(): PluginBase
    {
        return self::$plugin;
    }

    private static function setPlugin(PluginBase $plugin): void
    {
        self::$plugin = $plugin;
    }

    public static function createFakePlayer(string $name): Promise
    {
        $fakePlayerPlugin = self::getFakePlayerPlugin();

        return $fakePlayerPlugin->addPlayer(FakePlayerInfoBuilder::create()
            ->setUsername($name)
            ->setXuid(Uuid::uuid1()->toString())
            ->setUuid(Uuid::uuid4())
            ->build());
    }

    public static function launchTest(string $dir, string $namespace): void
    {
        try {
            $files = glob($dir . '/*Test.php');

            foreach ($files as $file) {
                require_once $file;

                // On suppose que le nom de la classe = nom du fichier sans extension
                $className = $namespace . basename($file, '.php');

                if (!class_exists($className)) {
                    self::getPlugin()->getLogger()->warning("§eClass $className not found in $file");
                    continue;
                }

                $testInstance = new $className();

                self::getPlugin()->getLogger()->info("§aSTART TEST IN : " . $className);
                sleep(1);

                foreach (get_class_methods($testInstance) as $method) {
                    if (str_ends_with($method, 'test')) {
                        try {
                            $testInstance->$method();
                            self::getPlugin()->getLogger()->info("§aTest : " . $method . " | ✅");
                        } catch (\Exception $e) {
                            self::getPlugin()->getLogger()->info("§cTest : " . $method . " | 🟥 : " . $e->getMessage());
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            self::getPlugin()->getLogger()->error("§cUnit tests failed: " . $th->getMessage());
            self::getPlugin()->getServer()->shutdown();
        }
    }
}