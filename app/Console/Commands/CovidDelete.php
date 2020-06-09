<?php


namespace App\Console\Commands;


use App\Service\StatServiceInteface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidDelete extends Command
{
    protected $signature = 'covid:delete {id}';


    protected $description = 'Delete stat covid';
    /**
     * @var StatServiceInteface $covidStatServise
     */
    private $covidStatServise;

    public function __construct(StatServiceInteface $statService)
    {
        $this->covidStatServise = $statService;
        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $id = $input->getArgument('id');
        try {
            if ($this->confirm('Do you wish delete')) {
            $this->covidStatServise->delete($id);
            }
            $this->info('Stat delete');

        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }
        return 0;


    }
}
