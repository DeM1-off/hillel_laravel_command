<?php


namespace App\Console\Commands;



use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidAdd extends Command
{

    protected $signature = 'covid:add  {country} {ill} {death} {good}';

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        return 0;


    }

}
