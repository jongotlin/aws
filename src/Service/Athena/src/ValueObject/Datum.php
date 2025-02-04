<?php

namespace AsyncAws\Athena\ValueObject;

/**
 * A piece of data (a field in the table).
 */
final class Datum
{
    /**
     * The value of the datum.
     */
    private $varCharValue;

    /**
     * @param array{
     *   VarCharValue?: null|string,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->varCharValue = $input['VarCharValue'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getVarCharValue(): ?string
    {
        return $this->varCharValue;
    }
}
