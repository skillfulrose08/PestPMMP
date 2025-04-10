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

    public static function launchTest(string $dir): void
    {
        try {
            $files = glob($dir . '/*Test.php');

            foreach ($files as $file) {
                require_once $file;

                $declaredClassesBefore = get_declared_classes();
                include_once $file;
                $declaredClassesAfter = get_declared_classes();

                $newClasses = array_diff($declaredClassesAfter, $declaredClassesBefore);

                foreach ($newClasses as $class) {
                    $reflection = new \ReflectionClass($class);

                    if ($reflection->isInstantiable()) {
                        $instance = $reflection->newInstance();
                        self::getPlugin()->getLogger()->info("§aSTART TEST IN : " . $instance->getName());
                        sleep(2);
                        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                            if (str_starts_with($method->getName(), 'test')) {
                                $isValid = $method->invoke($instance);
                                if ($isValid) {
                                    self::getPlugin()->getLogger()->info("§aTest : " . $method->getName() . " | GOOD");
                                } else {
                                    self::getPlugin()->getLogger()->info("§cTest : " . $method->getName() . " | FAILED");
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            self::getPlugin()->getLogger()->error("Units test failed. Please check PestPMMP installation.");
            self::getPlugin()->getServer()->shutdown();
        }
    }
}