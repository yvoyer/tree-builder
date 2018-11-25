<?php declare(strict_types=1);

namespace Star\Component\Tree;

interface CompilationContext
{
    /**
     * @return int
     */
    public function getCurrentLeft(): int;

    /**
     * @return int
     */
    public function getCurrentRight(): int;

    /**
     * @return int
     */
    public function getCurrentDepth(): int;

    /**
     * @return CompilationContext
     */
    public function nextSibling(): CompilationContext;

    /**
     * @return CompilationContext
     */
    public function nextChild(): CompilationContext;
}
