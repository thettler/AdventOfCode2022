<?php
require __DIR__.'/vendor/autoload.php';
require_once 'helper.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \Src\Day1());
$application->add(new \Src\Day2());
$application->add(new \Src\Day3());

$application->run();
