<?php

namespace App\Containers\Locations\Country\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Locations\Country\Data\Repositories\CountryRepository;

/**
 * Class GetAllCountriesTask
 *
 * @package App\Containers\Locations\Country\Tasks
 */
class GetAllCountriesTask extends Task
{

    /**
     * Hold repository.
     *
     * @var CountryRepository
     */
    protected CountryRepository $repository;

    /**
     * GetAllCountriesTask constructor.
     *
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run action.
     *
     * @return mixed
     */
    public function run()
    {
        return $this->repository->paginate();
    }
}
