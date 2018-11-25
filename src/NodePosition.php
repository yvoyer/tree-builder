<?php declare(strict_types=1);

namespace Star\Component\Tree;

final class NodePosition implements CompilationContext
{
    /**
     * @var int
     */
    private $left;

    /**
     * @var int
     */
    private $right;

    /**
     * @var int
     */
    private $depth;

    private function __construct(int $left, int $depth)
    {
        $this->left = $left;
        $this->depth = $depth;
    }

    /**
     * @return int
     */
    public function getCurrentDepth(): int
    {
        return $this->depth;
    }

    /**
     * @return int
     */
    public function getCurrentLeft(): int
    {
        return $this->left;
    }

    /**
     * @return int
     */
    public function getCurrentRight(): int
    {
        return $this->right;
    }

    /**
     * @return CompilationContext
     */
    public function nextSibling(): CompilationContext
    {
        return new self($this->left + 1, $this->depth);
    }

    /**
     * @return CompilationContext
     */
    public function nextChild(): CompilationContext
    {
        return new self($this->left + 1, $this->depth + 1);
    }

    /**
     * @return CompilationContext
     */
    public static function start(): CompilationContext
    {
        return new self(1, 1);
    }
}
