<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Agendamento Entity
 *
 * @property int $id
 * @property string $nome
 * @property \Cake\I18n\FrozenTime $data_hora
 * @property string $cpf_condutor
 * @property string $nome_condutor
 * @property string $cnpj_transportadora
 * @property string $nome_transportadora
 * @property string $cnpj_cliente
 * @property string $nome_cliente
 * @property string $placa_veiculo
 * @property string $placa_reboque_um
 * @property string $placa_reboque_dois
 * @property int $usuario_id
 * @property int $situacao_agendamento_id
 * @property int $operacao_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\SituacaoAgendamento $situacao_agendamento
 * @property \App\Model\Entity\Operacao $operacao
 * @property \App\Model\Entity\Notificaco[] $notificacoes
 */
class Agendamento extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'data_hora' => true,
        'cpf_condutor' => true,
        'nome_condutor' => true,
        'cnpj_transportadora' => true,
        'nome_transportadora' => true,
        'cnpj_cliente' => true,
        'nome_cliente' => true,
        'placa_veiculo' => true,
        'placa_reboque_um' => true,
        'placa_reboque_dois' => true,
        'usuario_id' => true,
        'situacao_agendamento_id' => true,
        'operacao_id' => true,
        'usuario' => true,
        'situacao_agendamento' => true,
        'operacao' => true,
        'notificacoes' => true
    ];
}
