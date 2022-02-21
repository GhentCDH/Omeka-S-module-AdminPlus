<?php
namespace AdminPlus;

use IIIFImport\Listener\ImportContentListener;
use IIIFImport\Listener\ViewContentListener;
use Laminas\Config\Factory;
use Laminas\EventManager\Event;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\ModuleManager\ModuleManager;
use Generic\AbstractModule;
use Laminas\View\Renderer\RendererInterface;

if (!class_exists(\Generic\AbstractModule::class)) {
    require file_exists(dirname(__DIR__) . '/Generic/AbstractModule.php')
        ? dirname(__DIR__) . '/Generic/AbstractModule.php'
        : __DIR__ . '/src/Generic/AbstractModule.php';
}

class Module extends AbstractModule
{
    const NAMESPACE = __NAMESPACE__;

    private $config;

    protected $dependencies = [];

    /**
     * @param ModuleManager $moduleManager
     */
    public function init(ModuleManager $moduleManager)
    {
        $this->loadVendor();
    }

    public function loadVendor()
    {
//        require_once __DIR__ . '/vendor/autoload.php';
    }

    public function getConfig()
    {
        if ($this->config) {
            return $this->config;
        }

        // Load our configuration.
        $this->config = Factory::fromFiles(
            glob(__DIR__ . '/config/*.config.php')
        );

        return $this->config;
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        // register css/js
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.layout',
            array($this, 'adminAssets')
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.layout',
            array($this, 'adminAssets')
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Media',
            'view.layout',
            array($this, 'adminAssets')
        );
    }

    public function adminAssets(Event $e)
    {
        $view = $e->getTarget();
        if ($view instanceof RendererInterface) {
            $view->headLink()->appendStylesheet($view->assetUrl('css/adminplus.css', 'AdminPlus'));
            $view->headScript()->appendFile($view->assetUrl('js/adminplus.js', 'AdminPlus'));
        }
    }

}
