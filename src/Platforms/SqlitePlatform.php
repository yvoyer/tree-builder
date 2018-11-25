<?php declare(strict_types=1);

namespace Star\Component\Tree\Platforms;

use Star\Component\Tree\Exception\DuplicateSubjectIdentifier;
use Star\Component\Tree\Exception\NodeNotFound;
use Star\Component\Tree\MappingPlatform;
use Star\Component\Tree\Schema\TableDefinition;
use Star\Component\Tree\TreeNode;

final class SqlitePlatform implements MappingPlatform
{
    /**
     * @var \SQLite3
     */
    private $sqlite;

    /**
     * @var TableDefinition
     */
    private $definition;

    public function __construct()
    {
        $this->sqlite = new \SQLite3(':memory:');
        $this->definition = new TableDefinition();

        $this->definition->createTable($this->sqlite);
    }

    public function __destruct()
    {
        $this->sqlite->close();
        unset($this->sqlite);
    }

    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function nodeExists(string $identifier): bool
    {
        return ! empty($this->definition->nodeWithId($this->sqlite, $identifier));
    }

    /**
     * @param TreeNode $node
     * @throws DuplicateSubjectIdentifier
     */
    public function insertNode(TreeNode $node): void
    {
        $this->definition->insertNode($this->sqlite, $node->getIdentifier(), $node->getDepth());
    }

    /**
     * @param string $identifier
     *
     * @return TreeNode
     * @throws NodeNotFound
     */
    public function getNode(string $identifier): TreeNode
    {
        var_dump($this->definition->nodeWithId($this->sqlite, $identifier));
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }

    /**
     * @return string[] The node identifiers
     */
    public function getRootNodes(): array
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }

    /**
     * Cleanup any corruption found in the tree
     */
    public function clean(): void
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
