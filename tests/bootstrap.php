<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerBuilder;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$container = new ContainerBuilder();

$GLOBALS['container'] = $container;
