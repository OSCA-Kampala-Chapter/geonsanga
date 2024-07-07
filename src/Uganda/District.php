<?php

declare(strict_types=1);

namespace Uganda;

use Uganda\Exceptions\CountyNotFoundException;
use Uganda\Exceptions\ParishNotFoundException;
use Uganda\Exceptions\SubCountyNotFoundException;
use Uganda\Exceptions\VillageNotFoundException;

final class District
{
    public int $id;

    public string $name;

    /** @var array<string, County> */
    public $counties;

    /**
     * @param int $id
     * @param string $name
     * @param array<string, County> $counties
     */
    public function __construct(int $id, string $name, array $counties = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->counties = $counties;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array<string, County>
     */
    public function counties(): array
    {
        return $this->counties;
    }

    /**
     * @throws CountyNotFoundException
     */
    public function county(string $name): County
    {
        if (!array_key_exists(strtolower($name), $this->counties)) {
            throw new CountyNotFoundException(sprintf('unable to locate county called %s', $name));
        }

        return $this->counties[strtolower($name)];
    }

    /** @return array<int, SubCounty> */
    public function subCounties(): array
    {
        $subCounties = [];
        foreach ($this->counties() as $county) {
            array_push($subCounties, ...array_values($county->subCounties()));
        }
        return $subCounties;
    }

    /**
     * @throws SubCountyNotFoundException
     */
    public function subCounty(string $name): SubCounty
    {
        foreach ($this->counties() as $county) {
            try {
                return $county->subCounty($name);
            } catch (SubCountyNotFoundException $exception) {
                continue;
            }
        }

        throw new SubCountyNotFoundException(sprintf('unable to locate sub county called %s', $name));
    }

    /** @return array<int, Parish> */
    public function parishes(): array
    {
        $parishes = [];
        foreach ($this->subCounties() as $subCounty) {
            array_push($parishes, ...array_values($subCounty->parishes()));
        }
        return $parishes;
    }

    /**
     * @throws ParishNotFoundException
     */
    public function parish(string $name): Parish
    {
        foreach ($this->subCounties() as $subCounty) {
            try {
                return $subCounty->parish($name);
            } catch (ParishNotFoundException $exception) {
                continue;
            }
        }

        throw new ParishNotFoundException(sprintf('unable to locate parish called %s', $name));
    }

    /** @return array<int, Village> */
    public function villages(): array
    {
        $villages = [];
        foreach ($this->parishes() as $parish) {
            array_push($villages, ...array_values($parish->villages()));
        }
        return $villages;
    }

    /**
     * @throws VillageNotFoundException
     */
    public function village(string $name): Village
    {
        foreach ($this->parishes() as $parish) {
            try {
                return $parish->village($name);
            } catch (VillageNotFoundException $exception) {
                continue;
            }
        }

        throw new VillageNotFoundException(sprintf('unable to locate village called %s', $name));
    }

    /** @return array<string,
    * array<string, array<string, array<string, array<string, array<string, array<string, array<array<string, int|string>>|int|string>>|int|string>>|int|string>>|int|string> 
    */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'counties' => array_map(static function (County $county) {
                return $county->toArray();
            }, $this->counties())
        ];
    }
}
