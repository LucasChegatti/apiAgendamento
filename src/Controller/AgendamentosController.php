<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Agendamento;

/**
 * Agendamentos Controller
 *
 *
 * @method \App\Model\Entity\Agendamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AgendamentosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        if ($this->request->is(['post'])) {
            if ($this->request->data['data_inicio'] && $this->request->data['data_fim']) {
                $conditions = "data_hora BETWEEN '" . $this->request->data['data_inicio'] . "' AND '" .  $this->request->data['data_fim'] . "'";

                $agendamentos = $this->Agendamentos->find('all', [
                    'conditions' => ['AND' => [ $conditions ]],
                    'contain' => ['SituacaoAgendamentos', 'Operacoes', 'Usuarios'],
                ])->toArray();

                $this->set('agendamentos', $agendamentos);
                return;
            }
        } else {
            $agendamentos = $this->paginate($this->Agendamentos->find('all')->contain(['SituacaoAgendamentos', 'Operacoes', 'Usuarios']));
        }
        $this->set(compact('agendamentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Agendamento id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $agendamento = $this->Agendamentos->get($id, [
            'contain' => ['SituacaoAgendamentos', 'Operacoes', 'Usuarios']
        ]);

        $this->set('agendamento', $agendamento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $agendamento = $this->Agendamentos->newEntity();
        if ($this->request->is('post')) {
            $agendamento = $this->Agendamentos->patchEntity($agendamento, $this->request->getData());
            if ($this->Agendamentos->save($agendamento)) {
                $this->set([ 
                    'success' => true,
                    'data' => "Agendamento adicionado com sucesso!",
                ]);

                $this->set('_serialize' , ['success', 'data']);
                return;
            }

            $this->response = $this->response->withStatus(400);
            $message = 'Não foi possível adicionar o agendamento!';
            $this->set(compact('message'));
            $this->set('_serialize', ['message']);
            return;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Agendamento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $agendamento = $this->Agendamentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $agendamento = $this->Agendamentos->patchEntity($agendamento, $this->request->getData());
            if ($this->Agendamentos->save($agendamento)) {
                $this->Flash->success(__('The agendamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The agendamento could not be saved. Please, try again.'));
        }
        $this->set(compact('agendamento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Agendamento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $agendamento = $this->Agendamentos->get($id);
        if ($this->Agendamentos->delete($agendamento)) {
            $this->Flash->success(__('The agendamento has been deleted.'));
        } else {
            $this->Flash->error(__('The agendamento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function indicadores (int $iPeriodo = null)
    {
        $oAgendamento = new Agendamento;
        switch ($iPeriodo) {
            case Agendamento::PERIODO_HOJE:
                $aAgendamentos = $oAgendamento->getCountAgendamentos($this, Agendamento::PERIODO_HOJE);
                break;

            case Agendamento::PERIODO_SEMANA:
                $aAgendamentos = $oAgendamento->getCountAgendamentos($this, Agendamento::PERIODO_SEMANA);
                break;

            case Agendamento::PERIODO_MES:
                $aAgendamentos = $oAgendamento->getCountAgendamentos($this, Agendamento::PERIODO_MES);
                break;

            case Agendamento::PERIODO_ANO:
                $aAgendamentos = $oAgendamento->getCountAgendamentos($this, Agendamento::PERIODO_ANO);
                break;
        }

        $this->set($aAgendamentos);
    }
}
