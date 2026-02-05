<?php

use League\Container\Container;
use League\Container\ReflectionContainer;

$container = new Container();

$container->delegate(new ReflectionContainer(true));

return $container;