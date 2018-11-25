<?php declare(strict_types=1);

namespace Star\Component\Tree;

use PHPUnit\Framework\TestCase;

final class NodePositionTest extends TestCase
{
    public function test_it_should_return_the_first_positions()
    {
        $position = NodePosition::start();
        $this->assertSame(1, $position->getCurrentLeft());
        $this->assertSame(2, $position->getCurrentRight());
        $this->assertSame(1, $position->getCurrentDepth());
    }
}
