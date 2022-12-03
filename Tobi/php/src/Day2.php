<?php

namespace Src;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'day2')]
class Day2 extends Command
{
    protected const ROCK = 'Rock';
    protected const PAPER = 'Paper';
    protected const SCISSORS = 'Scissors';

    protected array $scores = [
        'win' => 6,
        'draw' => 3,
        'lose' => 0,
        self::ROCK => 1,
        self::PAPER => 2,
        self::SCISSORS => 3,
    ];

    protected array $mapping = [
        self::ROCK => ['A', 'X'],
        self::PAPER => ['B', 'Y'],
        self::SCISSORS => ['C', 'Z'],
    ];

    protected array $winConditions = [
        'Rock' => 'Scissors',
        'Scissors' => 'Paper',
        'Paper' => 'Rock',
    ];

    protected array $outcomes = [
        'X' => 'lose',
        'Y' => 'draw',
        'Z' => 'win',
    ];

    protected function configure(): void
    {
        $this->addArgument('task', InputArgument::OPTIONAL, 'Task?', '1');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $task = $input->getArgument('task');
        $dataInput = getInput(2);
        $rounds = collect(explode(PHP_EOL, $dataInput))
            ->filter();


        if ($task === '1') {
            $rounds = $this->task1($rounds);
            $output->writeln('Final Score for Task 1: '.$rounds->sum());
            return Command::SUCCESS;
        }

        if ($task === '2') {
            $rounds = $this->task2($rounds);
            $output->writeln('Final Score for Task 2: '.$rounds->sum());
            return Command::SUCCESS;
        }

        $output->writeln('Task does not exist!');
        return Command::FAILURE;
    }


    protected function mapInput(string $input): string
    {
        foreach ($this->mapping as $key => $mapping) {
            if (!in_array($input, $mapping)) {
                continue;
            }

            return $key;
        }

        throw new \Exception('No valid Mapping found for '.$input);
    }

    protected function task2(Collection $input): Collection
    {
        return $input->map(function (string $round) {
            [$enemy, $outcome] = explode(' ', $round);
            return [
                'enemy' => $this->mapInput($enemy),
                'outcome' => $this->outcomes[$outcome]
            ];
        })
            ->map(function (array $round) {
                return match ($round['outcome']) {
                    'draw' => $this->scores['draw'] + $this->scores[$round['enemy']],
                    'lose' => $this->scores['lose'] + $this->scores[$this->winConditions[$round['enemy']]],
                    'win' => $this->scores['win'] + $this->scores[array_key_first(
                            Arr::where(
                                $this->winConditions,
                                fn(string $losing) => $losing === $round['enemy'])
                        )]
                };
            });
    }


    protected function task1(Collection $input): Collection
    {
        return $input->map(function (string $round) {
            [$enemy, $me] = explode(' ', $round);
            return [
                'enemy' => $this->mapInput($enemy),
                'me' => $this->mapInput($me)
            ];
        })
            ->map(function (array $round) {
                if ($round['me'] === $round['enemy']) {
                    return $this->scores['draw'] + $this->scores[$round['me']];
                }

                if ($this->winConditions[$round['me']] === $round['enemy']) {
                    return $this->scores['win'] + $this->scores[$round['me']];
                }

                return $this->scores['lose'] + $this->scores[$round['me']];
            });
    }
}
