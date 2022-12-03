<?php

namespace Src;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'day1')]
class Day1 extends Command
{
    protected function execute(InputInterface $dataInput, OutputInterface $output): int
    {
        $dataInput = getInput(1);

        $result = collect(explode(PHP_EOL.PHP_EOL, $dataInput))
            ->map(fn(string $chunk) => explode(PHP_EOL, $chunk))
            ->map(fn(array $chunk) => array_sum($chunk))
            ->sortDesc();

        $output->writeln('Top Elv: '.$result->first());
        $output->writeln('Top three Elves: ' .$result->take(3)->sum());

        return Command::SUCCESS;
    }
}
