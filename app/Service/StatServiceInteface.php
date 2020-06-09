<?php


namespace App\Service;


use App\Models\Countries;
use App\Models\CovidStat;
use Illuminate\Database\Eloquent\Collection;

interface StatServiceInteface
{
    public function add( array $data): void;
    public function list() : ?Collection;
    public function update( int $id , array $data): void;
    public function delete(int $id): void;
    public function get(int $id): ?CovidStat;
    public function getByCountry( string $country): ?Collection;


    public function getCountByName(string $name): Countries;
    public function getContries(): Collection;

}
