<?php


namespace App\Console\Commands;

use App\Model\CovidStat;
use Illuminate\Console\Command;
use App\Service\StatServiceInteface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidList extends Command
{
    protected $signature = 'covid:list';



    protected $description = 'Show stat list covid';

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
        $stat = $this->covidStatServise->list();

        $data = [];
        /** @var CovidStat $data */
        foreach ($stat as $item) {
            $data[] = [
                'country_name' => $item->country->name,
                'ill' => $item->ill_num,
                'death' => $item->death_num,
                'good' => $item->good_num
            ];
        }
        $this->table(
            ['Country Name', 'Illnes', 'Deaths', 'Get well'],
            $data
        );

        return 0;
    }

}
