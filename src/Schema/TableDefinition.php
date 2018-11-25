<?php declare(strict_types=1);

namespace Star\Component\Tree\Schema;

final class TableDefinition
{
    /**
     * @var FieldDefinition[]
     */
    private $fields = [];

    public function __construct()
    {
        $this->fields = [
            FieldDefinition::text('id'),
            FieldDefinition::integer('lft'),
            FieldDefinition::integer('rgt'),
            FieldDefinition::integer('depth'),
        ];
    }

    /**
     * @param \SQLite3 $sqlite
     */
    public function createTable(\SQLite3 $sqlite): void
    {
        $fields = implode(
            ',',
            array_map(
                function (FieldDefinition $field) {
                    return $field->name() . ' ' . $field->type();
                },
                $this->fields
            )
        );

        $sqlite->exec($sql = "CREATE TABLE star_tree ({$fields})");
    }

    /**
     * @param \SQLite3 $sqlite
     * @param string $identifier
     *
     * @return string[]
     */
    public function nodeWithId(\SQLite3 $sqlite, string $identifier): array
    {
        return $sqlite->querySingle(
            "SELECT * FROM star_tree WHERE id = {$this->escape($identifier)}",
            true
        );
    }

    /**
     * @param \SQLite3 $sqlite
     * @param string $id
     * @param int $depth
     */
    public function insertNode(\SQLite3 $sqlite, string $id, int $depth)
    {
        $sql = "INSERT INTO star_tree (id, lft, rgt, depth) VALUES (
            {$this->escape($id)},
            (SELECT CAST(MAX(rgt), AS INT) + 1 FROM star_tree),
            (SELECT CAST(MAX(lft) AS INT) + 1 FROM star_tree),            
            {$this->escape($depth)}
        )";

        $sqlite->exec($sql);
    }

    private function escape($value)
    {
        switch (gettype($value)) {
            case 'string':
                $value = "'{$value}'";
                break;
        }

        return $value;
    }
}
