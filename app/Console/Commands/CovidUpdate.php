<?php


namespace App\Console\Commands;


use App\Service\StatServiceInteface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidUpdate extends Command
{
    protected $signature = 'covid:update  {ill} {death} {good}';



    protected $description = 'Update stat  covid';

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


        $ill = $input->getArgument('ill');
        $death = $input->getArgument('death');
        $good = $input->getArgument('good');

        $id =  $this->ask('What is your id?');
        $countriesList = $this->covidStatServise->getContries()->pluck('name')->toArray();
        $country = $this->choice('Country name', $countriesList);



        $data = compact('ill', 'death', 'good');
        $data['country_name'] = $country;

        try {
            $this->covidStatServise->update($id,$data);

            $this->info('Date saved');

        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }




        return 0;
    }
}
