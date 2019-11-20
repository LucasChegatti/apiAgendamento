<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notificacoes Model
 *
 * @property \App\Model\Table\AgendamentosTable&\Cake\ORM\Association\BelongsTo $Agendamentos
 *
 * @method \App\Model\Entity\Notificaco get($primaryKey, $options = [])
 * @method \App\Model\Entity\Notificaco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Notificaco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notificaco|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notificaco saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notificaco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Notificaco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notificaco findOrCreate($search, callable $callback = null, $options = [])
 */
class NotificacoesTable extends Table
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

        $this->setTable('notificacoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Agendamentos', [
            'foreignKey' => 'agendamento_id',
            'joinType' => 'INNER'
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
            ->dateTime('data_hora')
            ->requirePresence('data_hora', 'create')
            ->notEmptyDateTime('data_hora');

        $validator
            ->scalar('texto')
            ->maxLength('texto', 255)
            ->requirePresence('texto', 'create')
            ->notEmptyString('texto');

        $validator
            ->dateTime('data_envio')
            ->requirePresence('data_envio', 'create')
            ->notEmptyDateTime('data_envio');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['agendamento_id'], 'Agendamentos'));

        return $rules;
    }
}
