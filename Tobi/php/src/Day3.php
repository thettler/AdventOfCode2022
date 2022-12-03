<?php

namespace Src;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'day3')]
class Day3 extends Command
{
    protected array $alphabet;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
        $this->alphabet = array_flip(range('a', 'z'));
    }

    protected function configure(): void
    {
        $this->addArgument('task', InputArgument::OPTIONAL, 'Task?', '1');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $task = $input->getArgument('task');
//        $data = getInput(3);
        $data = "vJrwpWtwJgWrhcsFMMfFFhFp
jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
PmmdzqPrVvPwwTWBwg
wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
ttgJtRGJQctTZtZT
CrZsJsPPZsGzwwsLwLmpwMDw";

        $result = collect(explode(PHP_EOL, $data))
            // Remove null values
            ->filter()
            // Split the rucksack into its compartments if Task 1
            ->when($task === '1',
                fn(Collection $collection) => $collection
                    ->map(fn(string $rucksack) => str_split($rucksack, strlen($rucksack) / 2))
            )
            // Split the rucksack into group of 3
            ->when($task === '2',
                fn(Collection $collection) => $collection->chunk(3)
                    ->map
                    ->toArray()
            )
            ->map(fn(array $compartments) => $this->findeDuplicate($compartments))
            ->map(fn(string $duplicate) => $this->assignScore($duplicate))
            ->sum();

        $output->writeln('The Result is: '.$result);
        return Command::SUCCESS;
    }

    protected function findeDuplicate(array $compartments)
    {
        $compartment1 = collect(str_split($compartments[0]));
        $compartment2 = str_split($compartments[1]);

        return $compartment1
            ->intersect($compartment2)
            ->unique()
            ->first();
    }

    protected function assignScore(string $duplicate)
    {
        if (ctype_upper($duplicate)) {
            return 26 + $this->alphabet[strtolower($duplicate)] + 1;
        }

        return $this->alphabet[strtolower($duplicate)] + 1;
    }
}
