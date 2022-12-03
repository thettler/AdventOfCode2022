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
        $data = getInput(3);

        $result = collect(explode(PHP_EOL, $data))
            ->filter()
            ->pipe(fn(Collection $collection) => match ($task) {
                '1' => $collection->map(fn(string $rucksack) => collect(str_split($rucksack, strlen($rucksack) / 2))),
                '2' => $collection->chunk(3)
                    ->map
                    ->values()
            })
            ->map(fn(Collection $compartments) => match ($task) {
                '1' => $this->findDuplicate($compartments[0], $compartments[1]),
                '2' => $this->findDuplicate($compartments[0], ...$compartments->slice(1)->toArray())
            })
            ->map(fn(string $duplicate) => $this->assignScore($duplicate))
            ->sum();

        $output->writeln('The Result is: '.$result);
        return Command::SUCCESS;
    }

    protected function findDuplicate(string $base, string ...$compares): string
    {
        $base = collect(str_split($base));

        foreach ($compares as $compare) {
            $compartment2 = str_split($compare);

            $base = $base
                ->intersect($compartment2)
                ->unique();
        }

        return $base->first();
    }

    protected function assignScore(string $duplicate)
    {
        if (ctype_upper($duplicate)) {
            return 26 + $this->alphabet[strtolower($duplicate)] + 1;
        }

        return $this->alphabet[strtolower($duplicate)] + 1;
    }
}
