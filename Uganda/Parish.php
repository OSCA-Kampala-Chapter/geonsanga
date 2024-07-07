<?php

declare(strict_types=1);

namespace Uganda;

use Uganda\Exceptions\VillageNotFoundException;

final class Parish
{
    public int $id;

    public string $name;

    public int $subCountyId;

    /** @var array<string, Village> */
    public array $villages;

    /**
     * @param int $id
     * @param string $name
     * @param int $subCountyId
     * @param array<string, Village> $villages
     */
    public function __construct(int $id, string $name, int $subCountyId, array $villages = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->subCountyId = $subCountyId;
        $this->villages = $villages;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function subCountyId(): int
    {
        return $this->subCountyId;
    }

    /** @return array<string, Village> */
    public function villages(): array
    {
        return $this->villages;
    }

    /**
     * @throws VillageNotFoundException
     */
    public function village(string $name): Village
    {
        if (!array_key_exists(strtolower($name), $this->villages)) {
            throw new VillageNotFoundException(sprintf('unable to locate village called %s', $name));
        }

        return $this->villages[strtolower($name)];
    }

    /** @return array<string, array<array<string, int|string>>|int|string> */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'subCountyId' => $this->subCountyId(),
            'villages' => array_map(static function (Village $village) {
                return $village->toArray();
            }, $this->villages())
        ];
    }
}
