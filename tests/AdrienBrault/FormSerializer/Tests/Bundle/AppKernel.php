<?php

namespace AdrienBrault\FormSerializer\Tests\Bundle;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),

            new \AdrienBrault\FormSerializer\Bundle\AdrienBraultFormSerializerBundle(),
        );
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/FSCHateoasBundle/';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}
