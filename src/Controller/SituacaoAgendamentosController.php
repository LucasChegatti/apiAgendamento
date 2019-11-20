<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SituacaoAgendamentos Controller
 *
 *
 * @method \App\Model\Entity\SituacaoAgendamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SituacaoAgendamentosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $situacaoAgendamentos = $this->paginate($this->SituacaoAgendamentos);

        $this->set(compact('situacaoAgendamentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Situacao Agendamento id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $situacaoAgendamento = $this->SituacaoAgendamentos->get($id, [
            'contain' => []
        ]);

        $this->set('situacaoAgendamento', $situacaoAgendamento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $situacaoAgendamento = $this->SituacaoAgendamentos->newEntity();
        if ($this->request->is('post')) {
            $situacaoAgendamento = $this->SituacaoAgendamentos->patchEntity($situacaoAgendamento, $this->request->getData());
            if ($this->SituacaoAgendamentos->save($situacaoAgendamento)) {
                $this->Flash->success(__('The situacao agendamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The situacao agendamento could not be saved. Please, try again.'));
        }
        $this->set(compact('situacaoAgendamento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Situacao Agendamento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $situacaoAgendamento = $this->SituacaoAgendamentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $situacaoAgendamento = $this->SituacaoAgendamentos->patchEntity($situacaoAgendamento, $this->request->getData());
            if ($this->SituacaoAgendamentos->save($situacaoAgendamento)) {
                $this->Flash->success(__('The situacao agendamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The situacao agendamento could not be saved. Please, try again.'));
        }
        $this->set(compact('situacaoAgendamento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Situacao Agendamento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $situacaoAgendamento = $this->SituacaoAgendamentos->get($id);
        if ($this->SituacaoAgendamentos->delete($situacaoAgendamento)) {
            $this->Flash->success(__('The situacao agendamento has been deleted.'));
        } else {
            $this->Flash->error(__('The situacao agendamento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
