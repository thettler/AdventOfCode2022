<?php

function getInput(int $day): string
{
   return file_get_contents(__DIR__ . "/../Inputs/InputDay{$day}.txt");
}
