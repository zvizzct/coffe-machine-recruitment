#!/usr/bin/env php
<?php
// application.php


require __DIR__.'/vendor/autoload.php';

use Pdpaola\CoffeeMachine\Command\MakeDrinkCommand;
use Pdpaola\CoffeeMachine\Command\ReportEarningsCommand;
use Pdpaola\CoffeeMachine\Infrastructure\Database\MysqlPdoClient;
use Pdpaola\CoffeeMachine\Repository\OrderRepository;
use Pdpaola\CoffeeMachine\Service\ReportEarnings;
use Pdpaola\CoffeeMachine\Service\InputValidator;
use Pdpaola\CoffeeMachine\Service\OrderProcessor;
use Symfony\Component\Console\Application;

$pdoClient = new MysqlPdoClient();
$pdo = $pdoClient->getPdo();

// service and repository instances
$orderRepository = new OrderRepository($pdo);
$earningsService = new ReportEarnings($orderRepository);
$orderProcessor = new OrderProcessor($orderRepository);
$inputValidator = new InputValidator();

// command instances
$makeDrinkCommand = new MakeDrinkCommand($inputValidator, $orderProcessor);
$showEarningsCommand = new ReportEarningsCommand($earningsService);

// app configuration and commands
$application = new Application();
$application->add($makeDrinkCommand);
$application->add($showEarningsCommand);

$application->run();

