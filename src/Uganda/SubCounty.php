<?php

declare(strict_types=1);

namespace Uganda;

use Uganda\Exceptions\ParishNotFoundException;
use Uganda\Exceptions\VillageNotFoundException;

final class SubCounty
{
    public int $id;

    public string $name;

    public int $countyId;

    /** @var array<string, Parish> */
    public array $parishes;

    /**
     * @param int $id
     * @param string $name
     * @param array<string, Parish> $parishes
     */
    public function __construct(int $id, string $name, int $countyId, array $parishes = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->countyId = $countyId;
        $this->parishes = $parishes;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function countyId(): int
    {
        return $this->countyId;
    }

    /** @return array<string, Parish> */
    public function parishes(): array
    {
        return $this->parishes;
    }

    public function parish(string $name): Parish
    {
        if (!array_key_exists(strtolower($name), $this->parishes)) {
            throw new ParishNotFoundException(sprintf('unable to locate parish called %s', $name));
        }

        return $this->parishes[strtolower($name)];
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

    /** @return array<string, array<string, array<string, array<array<string, int|string>>|int|string>>|int|string> */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'countyId' => $this->countyId(),
            'parishes' => array_map(static function (Parish $parish) {
                return $parish->toArray();
            }, $this->parishes())
        ];
    }
}
