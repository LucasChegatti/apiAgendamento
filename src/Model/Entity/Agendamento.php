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
    const PERIODO_HOJE   = 1;
    const PERIODO_SEMANA = 2;
    const PERIODO_MES    = 3;
    const PERIODO_ANO    = 4;

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

    public function getCountAgendamentos ($that, int $iPeriodo)
    {
        switch ($iPeriodo) {
            case Agendamento::PERIODO_HOJE:
                $conditions = "(DAY(data_hora) = DAY(now()))";
                break;

            case Agendamento::PERIODO_SEMANA:
                $conditions = "(WEEK(data_hora) = WEEK(now()))";
                break;

            case Agendamento::PERIODO_MES:
                $conditions = "(MONTH(data_hora) = MONTH(now()))";
                break;

            case Agendamento::PERIODO_ANO:
                $conditions = "(YEAR(data_hora) = YEAR(now()))";
                break;
        }

        $aAgendamentos = $that->Agendamentos->find('all', [
            'conditions' => ['AND' => [ $conditions ]]
        ])->toArray();

        $aAgendamentosSituacao = $this->getCountSituacaoAgendamentos($aAgendamentos);
        return $aAgendamentosSituacao;
    }

    private function getCountSituacaoAgendamentos ($aAgendamentos)
    {
        $array['Cadastrando']           = 0;
        $array['Aprovado']              = 0;
        $array['Trânsito Iniciado']     = 0;
        $array['Confirmado na Triagem'] = 0;
        $array['Dentro do Recinto']     = 0;
        $array['Liberado']              = 0;
        $array['Rejeitado']             = 0;

        foreach ($aAgendamentos as $agendamento) {
            switch ($agendamento->situacao_agendamento_id) {
                case 1:
                    $array['Cadastrando']++;
                    break;
                
                case 2:
                    $array['Aprovado']++;
                    break;

                case 3:
                    $array['Trânsito Iniciado']++;
                    break;

                case 4:
                    $array['Confirmado na Triagem']++;
                    break;

                case 5:
                    $array['Dentro do Recinto']++;
                    break;

                case 6:
                    $array['Liberado']++;
                    break;

                case 7:
                    $array['Rejeitado']++;
                    break;
            }
        }
        return $array;
    }
}
