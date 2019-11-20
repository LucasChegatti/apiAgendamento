<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notificaco Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $data_hora
 * @property string $texto
 * @property \Cake\I18n\FrozenTime $data_envio
 * @property int $agendamento_id
 *
 * @property \App\Model\Entity\Agendamento $agendamento
 */
class Notificaco extends Entity
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
        'data_hora' => true,
        'texto' => true,
        'data_envio' => true,
        'agendamento_id' => true,
        'agendamento' => true
    ];
}
