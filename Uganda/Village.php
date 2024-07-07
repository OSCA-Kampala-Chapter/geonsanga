<?php

declare(strict_types=1);

namespace Uganda;

final class Village
{
    public int $id;

    public string $name;

    public int $parishId;

    public function __construct(int $id, string $name, int $parish)
    {
        $this->id = $id;
        $this->name = ucwords(strtolower($name));
        $this->parishId = $parish;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function parishId(): int
    {
        return $this->parishId;
    }

    /** @return array<string, int|string> */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'parishId' => $this->parishId()
        ];
    }
}
