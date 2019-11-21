<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Agendamentos Model
 *
 * @property \App\Model\Table\UsuariosTable&\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\SituacaoAgendamentosTable&\Cake\ORM\Association\BelongsTo $SituacaoAgendamentos
 * @property \App\Model\Table\OperacaosTable&\Cake\ORM\Association\BelongsTo $Operacaos
 * @property \App\Model\Table\NotificacoesTable&\Cake\ORM\Association\HasMany $Notificacoes
 *
 * @method \App\Model\Entity\Agendamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Agendamento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Agendamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Agendamento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Agendamento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Agendamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Agendamento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Agendamento findOrCreate($search, callable $callback = null, $options = [])
 */
class AgendamentosTable extends Table
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

        $this->setTable('agendamentos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SituacaoAgendamentos', [
            'foreignKey' => 'situacao_agendamento_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Operacoes', [
            'foreignKey' => 'operacao_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Notificacoes', [
            'foreignKey' => 'agendamento_id'
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
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->dateTime('data_hora')
            ->requirePresence('data_hora', 'create')
            ->notEmptyDateTime('data_hora');

        $validator
            ->scalar('cpf_condutor')
            ->maxLength('cpf_condutor', 11)
            ->requirePresence('cpf_condutor', 'create')
            ->notEmptyString('cpf_condutor');

        $validator
            ->scalar('nome_condutor')
            ->maxLength('nome_condutor', 255)
            ->requirePresence('nome_condutor', 'create')
            ->notEmptyString('nome_condutor');

        $validator
            ->scalar('cnpj_transportadora')
            ->maxLength('cnpj_transportadora', 45)
            ->requirePresence('cnpj_transportadora', 'create')
            ->notEmptyString('cnpj_transportadora');

        $validator
            ->scalar('nome_transportadora')
            ->maxLength('nome_transportadora', 255)
            ->requirePresence('nome_transportadora', 'create')
            ->notEmptyString('nome_transportadora');

        $validator
            ->scalar('cnpj_cliente')
            ->maxLength('cnpj_cliente', 45)
            ->requirePresence('cnpj_cliente', 'create')
            ->notEmptyString('cnpj_cliente');

        $validator
            ->scalar('nome_cliente')
            ->maxLength('nome_cliente', 255)
            ->requirePresence('nome_cliente', 'create')
            ->notEmptyString('nome_cliente');

        $validator
            ->scalar('placa_veiculo')
            ->maxLength('placa_veiculo', 45)
            ->requirePresence('placa_veiculo', 'create')
            ->notEmptyString('placa_veiculo');

        $validator
            ->scalar('placa_reboque_um')
            ->maxLength('placa_reboque_um', 45)
            ->requirePresence('placa_reboque_um', 'create')
            ->notEmptyString('placa_reboque_um');

        $validator
            ->scalar('placa_reboque_dois')
            ->maxLength('placa_reboque_dois', 45)
            ->requirePresence('placa_reboque_dois', 'create')
            ->notEmptyString('placa_reboque_dois');

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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));
        $rules->add($rules->existsIn(['situacao_agendamento_id'], 'SituacaoAgendamentos'));
        $rules->add($rules->existsIn(['operacao_id'], 'Operacoes'));

        return $rules;
    }
}
