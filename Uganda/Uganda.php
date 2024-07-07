<?php

declare(strict_types=1);

namespace Uganda;

use Uganda\Exceptions\CountyNotFoundException;
use Uganda\Exceptions\DistrictNotFoundException;
use Uganda\Exceptions\ParishNotFoundException;
use Uganda\Exceptions\SubCountyNotFoundException;
use Uganda\Exceptions\VillageNotFoundException;

final class Uganda
{
    /**
     * @var array<string, District>
     */
    public array $districts;

    public function __construct()
    {
        $this->districts = $this->generateTree();
    }

    /**
     * @return array<string, District>
     */
    public function districts(): array
    {
        return $this->districts;
    }

    /**
     * @throws DistrictNotFoundException
     */
    public function district(string $name): District
    {
        if (!array_key_exists(strtolower($name), $this->districts)) {
            throw new DistrictNotFoundException(sprintf('unable to locate district called %s', $name));
        }

        return $this->districts[strtolower($name)];
    }

    /**
     * @return array<int, County>
     */
    public function counties(): array
    {
        $counties = [];
        foreach ($this->districts() as $district) {
            array_push($counties, ...array_values($district->counties()));
        }
        return $counties;
    }

    /**
     * @throws CountyNotFoundException
     */
    public function county(string $name): County
    {
        foreach ($this->districts() as $district) {
            try {
                return $district->county($name);
            } catch (CountyNotFoundException $exception) {
                continue;
            }
        }

        throw new CountyNotFoundException();
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

        throw new SubCountyNotFoundException();
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
        $name = strtolower($name);
        foreach ($this->subCounties() as $subCounty) {
            try {
                return $subCounty->parish($name);
            } catch (ParishNotFoundException $exception) {
                continue;
            }
        }

        throw new ParishNotFoundException();
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

        throw new VillageNotFoundException();
    }

    /** @return array<string, District> */
    private function generateTree(): array
    {
        /** @var array<int, array<string, string>> $villages */
        $villages = $this->getFileContents(__DIR__ . '/Data/villages.json');

        /** @var array<int, array<string, string>> $parishes */
        $parishes = $this->getFileContents(__DIR__ . '/Data/parishes.json');

        /** @var array<int, array<string, string>> $subCounties */
        $subCounties = $this->getFileContents(__DIR__ . '/Data/sub_counties.json');

        /** @var array<int, array<string, string>> $counties */
        $counties = $this->getFileContents(__DIR__ . '/Data/counties.json');

        /** @var array<int, array<string, string>> $districts */
        $districts = $this->getFileContents(__DIR__ . '/Data/districts.json');

        /** @var array<string, array<string, Village>> $mappedVillages */
        $mappedVillages = [];
        foreach ($villages as $village) {
            $mappedVillages[$village['parish']][strtolower($village['name'])] = new Village(
                (int) $village['id'],
                $village['name'],
                (int) $village['parish']
            );
        }

        /** @var array<string, array<string, Parish>> $mappedParishes */
        $mappedParishes = [];
        foreach ($parishes as $parish) {
            $mappedParishes[$parish['subcounty']][strtolower($parish['name'])] = new Parish(
                (int) $parish['id'],
                ucfirst($parish['name']),
                (int) $parish['subcounty'],
                $mappedVillages[$parish['id']] ?? []
            );
        }

        /** @var array<string, array<string, SubCounty>> $mappedSubCounties */
        $mappedSubCounties = [];
        foreach ($subCounties as $subCounty) {
            $mappedSubCounties[$subCounty['county']][strtolower($subCounty['name'])] = new SubCounty(
                (int) $subCounty['id'],
                ucfirst($subCounty['name']),
                (int) $subCounty['county'],
                $mappedParishes[$subCounty['id']] ?? []
            );
        }

        /** @var array<string, array<string, County>> $mappedCounties */
        $mappedCounties = [];
        foreach ($counties as $county) {
            $mappedCounties[$county['district']][strtolower($county['name'])] = new County(
                (int) $county['id'],
                ucfirst($county['name']),
                (int) $county['district'],
                $mappedSubCounties[$county['id']] ?? []
            );
        }

        /** @var array<string, District> $mappedDistrict */
        $mappedDistrict = [];
        foreach ($districts as $district) {
            $mappedDistrict[strtolower($district['name'])] = new District(
                (int) $district['id'],
                ucfirst($district['name']),
                $mappedCounties[$district['id']] ?? []
            );
        }

        return $mappedDistrict;
    }

    /** @return array<string, string> */
    private function getFileContents(string $filePath): array
    {
        try {
            /** @var array<string, string> $response */
            $response = (array) json_decode(
                (string) file_get_contents($filePath),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $jsonException) {
            return [];
        }

        return $response;
    }
}
