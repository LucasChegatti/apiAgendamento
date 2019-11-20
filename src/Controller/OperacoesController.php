<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Operacoes Controller
 *
 *
 * @method \App\Model\Entity\Operaco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OperacoesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $operacoes = $this->paginate($this->Operacoes);

        $this->set(compact('operacoes'));
    }

    /**
     * View method
     *
     * @param string|null $id Operacao id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $operacao = $this->Operacoes->get($id, [
            'contain' => []
        ]);

        $this->set('operacao', $operacao);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $operacao = $this->Operacoes->newEntity();
        if ($this->request->is('post')) {
            $operacao = $this->Operacoes->patchEntity($operacao, $this->request->getData());
            if ($this->Operacoes->save($operacao)) {
                $this->Flash->success(__('The operacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The operacao could not be saved. Please, try again.'));
        }
        $this->set(compact('operacao'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Operacao id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $operacao = $this->Operacoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $operacao = $this->Operacoes->patchEntity($operacao, $this->request->getData());
            if ($this->Operacoes->save($operaco)) {
                $this->Flash->success(__('The operacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The operacao could not be saved. Please, try again.'));
        }
        $this->set(compact('operacao'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Operacao id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $operacao = $this->Operacoes->get($id);
        if ($this->Operacoes->delete($operacao)) {
            $this->Flash->success(__('The operacao has been deleted.'));
        } else {
            $this->Flash->error(__('The operacao could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
