<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AgendamentosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AgendamentosTable Test Case
 */
class AgendamentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AgendamentosTable
     */
    public $Agendamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Agendamentos',
        'app.Usuarios',
        'app.SituacaoAgendamentos',
        'app.Operacaos',
        'app.Notificacoes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Agendamentos') ? [] : ['className' => AgendamentosTable::class];
        $this->Agendamentos = TableRegistry::getTableLocator()->get('Agendamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Agendamentos);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
