<?php

namespace App\Containers\Locations\Country\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Locations\Country\Models\Country;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\Locations\Country\Data\Repositories\CountryRepository;

/**
 * Class CreateCountryTask
 *
 * @package App\Containers\Locations\Country\Tasks
 */
class CreateCountryTask extends Task
{

    /**
     * Hold repository.
     *
     * @var CountryRepository
     */
    protected CountryRepository $repository;

    /**
     * CreateCountryTask constructor.
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
     * @param   array $data
     *
     * @return  Country
     *
     * @throws  CreateResourceFailedException
     */
    public function run(array $data): Country
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
