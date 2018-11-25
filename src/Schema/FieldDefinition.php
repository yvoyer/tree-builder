<?php declare(strict_types=1);

namespace Star\Component\Tree\Schema;

final class FieldDefinition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $name
     * @param string $type
     */
    private function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = strtoupper($type);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @param string $name
     *
     * @return FieldDefinition
     */
    public static function text(string $name): self
    {
        return new self($name, 'text');
    }

    /**
     * @param string $name
     *
     * @return FieldDefinition
     */
    public static function integer(string $name): self
    {
        return new self($name, 'integer');
    }
}
