<?php


namespace App\Console\Commands;



use App\Service\StatServiceInteface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidAdd extends Command
{

    protected $signature = 'covid:add {ill} {death} {good}';


    protected $description = 'Send drip e-mails to a user';
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

        $countriesList = $this->covidStatServise->getContries()->pluck('name')->toArray();
        $country = $this->choice('Country name', $countriesList);

        $ill = $input->getArgument('ill');
        $death = $input->getArgument('death');
        $good = $input->getArgument('good');

        $data = compact('ill', 'death', 'good');
        $data['country_name'] = $country;

        try {
            $this->covidStatServise->add($data);

            $this->info('Date saved');

        }catch (\InvalidArgumentException $exception)
        {
            $this->error('ERROR : '. $exception->getMessage());
        }
        return 0;


    }

}
