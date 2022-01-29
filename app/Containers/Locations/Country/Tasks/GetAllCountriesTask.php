<?php

namespace App\Containers\Locations\Country\Tasks;

use App\Containers\Locations\Country\Data\Repositories\CountryRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllCountriesTask extends Task
{
    protected CountryRepository $repository;

    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
