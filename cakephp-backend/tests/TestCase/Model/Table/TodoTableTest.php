<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TodoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TodoTable Test Case
 */
class TodoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TodoTable
     */
    protected $Todo;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Todo',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Todo') ? [] : ['className' => TodoTable::class];
        $this->Todo = $this->getTableLocator()->get('Todo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Todo);

        parent::tearDown();
    }
}
