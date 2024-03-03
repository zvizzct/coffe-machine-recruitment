#!/usr/bin/env php
<?php
// application.php


require __DIR__.'/vendor/autoload.php';

use Pdpaola\CoffeeMachine\Command\MakeDrinkCommand;
use Pdpaola\CoffeeMachine\Infrastructure\Database\MysqlPdoClient;
use Pdpaola\CoffeeMachine\Repository\OrderRepository;
use Pdpaola\CoffeeMachine\Service\InputValidator;
use Pdpaola\CoffeeMachine\Service\OrderProcessor;
use Symfony\Component\Console\Application;

$pdoClient = new MysqlPdoClient();
$pdo = $pdoClient->getPdo();

// Instancias de los servicios y repositorios
$orderRepository = new OrderRepository($pdo);
$orderProcessor = new OrderProcessor($orderRepository);
$inputValidator = new InputValidator();

// Instancias de los comandos
$makeDrinkCommand = new MakeDrinkCommand($inputValidator, $orderProcessor);

// Configuración de la aplicación y registro de comandos
$application = new Application();
$application->add($makeDrinkCommand);

$application->run();

