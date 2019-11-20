<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SituacaoAgendamentosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SituacaoAgendamentosTable Test Case
 */
class SituacaoAgendamentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SituacaoAgendamentosTable
     */
    public $SituacaoAgendamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SituacaoAgendamentos',
        'app.Agendamentos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SituacaoAgendamentos') ? [] : ['className' => SituacaoAgendamentosTable::class];
        $this->SituacaoAgendamentos = TableRegistry::getTableLocator()->get('SituacaoAgendamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SituacaoAgendamentos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
