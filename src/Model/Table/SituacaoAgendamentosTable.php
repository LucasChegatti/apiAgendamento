<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SituacaoAgendamentos Model
 *
 * @property \App\Model\Table\AgendamentosTable&\Cake\ORM\Association\HasMany $Agendamentos
 *
 * @method \App\Model\Entity\SituacaoAgendamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SituacaoAgendamento findOrCreate($search, callable $callback = null, $options = [])
 */
class SituacaoAgendamentosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('situacao_agendamentos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Agendamentos', [
            'foreignKey' => 'situacao_agendamento_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 45)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 255)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        return $validator;
    }
}
