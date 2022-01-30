<?php

namespace App\Containers\Locations\Country\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Locations\Country\Models\Country;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\Locations\Country\Data\Repositories\CountryRepository;

/**
 * Class UpdateCountryTask
 *
 * @package App\Containers\Locations\Country\Tasks
 */
class UpdateCountryTask extends Task
{

    /**
     * Hold CountryRepository.
     *
     * @var CountryRepository
     */
    protected CountryRepository $repository;

    /**
     * UpdateCountryTask constructor.
     *
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run update country action.
     *
     * @param   mixed $id
     * @param   array $data
     *
     * @return  Country
     *
     * @throws  UpdateResourceFailedException
     */
    public function run($id, array $data): Country
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception->getMessage());
        }
    }
}
