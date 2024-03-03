<?php

namespace Pdpaola\CoffeeMachine\Command;

use Pdpaola\CoffeeMachine\Interface\InputValidatorInterface;
use Pdpaola\CoffeeMachine\Interface\OrderProcessorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command {
    private $inputValidator;
    private $orderProcessor;

    public function __construct(InputValidatorInterface $inputValidator, OrderProcessorInterface $orderProcessor) {
        // Dependency injection
        $this->inputValidator = $inputValidator;
        $this->orderProcessor = $orderProcessor;
        parent::__construct();
    }

    protected function configure() {
        $this
            ->setName('app:order-drink')
            ->setDescription('Order a drink from the coffee machine.')
            ->setHelp('This command allows you to order a drink from the coffee machine with some options.')
            ->addArgument('drink-type', InputArgument::REQUIRED, 'The type of the drink. (Tea, Coffee, or Chocolate)')
            ->addArgument('money', InputArgument::REQUIRED, 'The amount of money given by the user')
            ->addArgument('sugars', InputArgument::OPTIONAL, 'The number of sugars you want. (0, 1, 2)', 0)
            ->addOption('extra-hot', 'e', InputOption::VALUE_NONE, 'If the user wants to make the drink extra hot');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        try {
            $validatedInput = $this->inputValidator->validateInput($input);
            $message = $this->orderProcessor->processOrder($validatedInput);
            $output->writeln($message);
            return 1;
        } catch (\InvalidArgumentException $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return 0;
        }
    }
}
