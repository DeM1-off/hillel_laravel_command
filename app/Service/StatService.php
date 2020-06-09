<?php


namespace App\Service;


use App\Models\Countries;
use App\Models\CovidStat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StatService implements StatServiceInteface
{


    public function add(array $data) : void
    {
        /** @var Countries $country */
        $country =  $this->getCountByName($data['country_name']);
        if (!$country) {
            throw new \InvalidArgumentException('Country does not exists');
        }

        $stat = new CovidStat();
        $stat->ill_num = $data['ill'];
        $stat->death_num = $data['death'];
        $stat->good_num = $data['good'];
        $stat->country()->associate($country)->save();

    }

    public function getContries() : Collection
    {

        return Countries::all('name');

    }

    public function getCountByName(string $name): Countries
    {
        return Countries::where('name', '=', $name)->first();
    }

    public function list() : ?Collection
    {
         return CovidStat::all();
    }

    public function update(int $id,array $data) : void
    {

        /** @var Countries $country */
        $country =  $this->getCountByName($data['country_name']);

        if (!$country) {
            throw new \InvalidArgumentException('Country does not exists');
        }

        $stat = CovidStat::find($id);
        $stat->ill_num = $data['ill'];
        $stat->death_num = $data['death'];
        $stat->good_num = $data['good'];
        $stat->country()->associate($country)->save();
    }

    public function delete(int $id) : void
    {

        $stat = CovidStat::findOrFail($id);
        $stat->delete();

    }

    public function get(int $id) : ?CovidStat
    {
        return CovidStat::findOrFail($id);
    }

    public function getByCountry(string $country) : ?Collection
    {


       return Countries::find($country);

    }
}
