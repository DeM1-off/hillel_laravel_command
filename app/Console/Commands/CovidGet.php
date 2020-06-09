<?php


namespace App\Console\Commands;


use App\Service\StatServiceInteface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidGet extends Command
{
    protected $signature = 'covid:get {id}';



    protected $description = 'Get stat  covid';

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


        try {
            $id = $input->getArgument('id');
            $stat = $this->covidStatServise->get($id);
            $data = [];
            /** @var CovidStat $data */
                $data[] = [
                    'id' => $stat->id,
                    'country_id' =>  $stat->country->name,
                    'ill_num' => $stat->ill_num,
                    'death_num' => $stat->death_num,
                    'good_num' => $stat->good_num,

                ];

            $this->table(
                ['id', 'country_name', 'ill_num', 'death_num', 'good_num'],
                $data
            );

        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }




        return 0;
    }
}
