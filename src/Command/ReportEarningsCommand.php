<?php
namespace Pdpaola\CoffeeMachine\Command;

use Pdpaola\CoffeeMachine\Service\ReportEarnings;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReportEarningsCommand extends Command
{
    private $reportEarnings;

    public function __construct(ReportEarnings $reportEarnings)
    {
        parent::__construct();
        $this->reportEarnings = $reportEarnings;
    }

    protected function configure()
    {
        $this
            ->setName('app:report-earnings')
            ->setDescription('Reports earnings per drink type.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $earnings = $this->reportEarnings->calculateEarnings();

            foreach ($earnings as $drinkType => $money) {
                $formattedMoney = number_format($money, 2);
                $output->writeln("Drink: $drinkType, Earnings: \${$formattedMoney}");
            }
        } catch (\Exception $e) {
            $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
            return 0;
        }

        return 1; 
    }
}
