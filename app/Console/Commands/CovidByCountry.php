<?php


namespace App\Console\Commands;

use App\Service\StatServiceInteface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidByCountry extends Command
{
    protected $signature = 'covid:country {name}';


    protected $description = 'Show country';
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
        $name = $input->getArgument('name');
        try {

            $stat = DB::table('covid_stats')
                ->join('countries', 'countries.id', '=', 'covid_stats.country_id')
                ->select('name','ill_num','death_num','good_num')
                ->where('name','=',$name)
                ->get();

            $data = [];

            /** @var CovidStat $data */
            foreach ($stat as $item) {
                $data[] = [
                    'name' => $item->name,
                    'ill' => $item->ill_num,
                    'death' => $item->death_num,
                    'good' => $item->good_num
                ];
            }
            $this->table(
                ['Country Name', 'Illnes', 'Deaths', 'Get well'],
                $data
            );
        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }
        return 0;


    }
}
