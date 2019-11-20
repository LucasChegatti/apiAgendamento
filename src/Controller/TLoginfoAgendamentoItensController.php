<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TLoginfoAgendamentoItens Controller
 *
 *
 * @method \App\Model\Entity\TLoginfoAgendamentoIten[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TLoginfoAgendamentoItensController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tLoginfoAgendamentoItens = $this->paginate($this->TLoginfoAgendamentoItens);

        $this->set(compact('tLoginfoAgendamentoItens'));
        $this->set('_serialize', ['tLoginfoAgendamentoItens']);
    }

    /**
     * View method
     *
     * @param string|null $id T Loginfo Agendamento Iten id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tLoginfoAgendamentoIten = $this->TLoginfoAgendamentoItens->get($id, [
            'contain' => []
        ]);

        $this->set(compact('tLoginfoAgendamentoIten'));
        $this->set('_serialize', ['tLoginfoAgendamentoIten']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tLoginfoAgendamentoIten = $this->TLoginfoAgendamentoItens->newEntity();
        if ($this->request->is('post')) {
            $tLoginfoAgendamentoIten = $this->TLoginfoAgendamentoItens->patchEntity($tLoginfoAgendamentoIten, $this->request->getData());
            if ($this->TLoginfoAgendamentoItens->save($tLoginfoAgendamentoIten)) {
                $mensagem = ['success'=>true, 'mensagem'=>'The t loginfo agendamento iten has been saved.'];
                $this->set(compact('mensagem'));
                $this->set('_serialize', ['mensagem']);
                return;
            }
            $mensagem = ['success'=>false, 'mensagem'=>'The t loginfo agendamento iten has not been saved.'];
        }
        $this->set(compact('mensagem'));
        $this->set('_serialize', ['mensagem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id T Loginfo Agendamento Iten id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tLoginfoAgendamentoIten = $this->TLoginfoAgendamentoItens->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tLoginfoAgendamentoIten = $this->TLoginfoAgendamentoItens->patchEntity($tLoginfoAgendamentoIten, $this->request->getData());
            if ($this->TLoginfoAgendamentoItens->save($tLoginfoAgendamentoIten)) {
                $this->set(compact('mensagem'));
                $this->set('_serialize', ['mensagem']);
                return;
            }
            $mensagem = ['success'=>false, 'mensagem'=>'The t loginfo agendamento iten has not been saved.'];
        }
        $this->set(compact('mensagem'));
        $this->set('_serialize', ['mensagem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id T Loginfo Agendamento Iten id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tLoginfoAgendamentoIten = $this->TLoginfoAgendamentoItens->get($id);
        if ($this->TLoginfoAgendamentoItens->delete($tLoginfoAgendamentoIten)) {
            $mensagem = ['success'=>false, 'mensagem'=>'The t loginfo agendamento iten been deleted.'];
        } else {
            $mensagem = ['success'=>false, 'mensagem'=>'The t loginfo agendamento iten not been deleted.'];
        }
        $this->set(compact('mensagem'));
        $this->set('_serialize', ['mensagem']);
    }
}
