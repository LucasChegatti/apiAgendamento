<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notificacoes Controller
 *
 *
 * @method \App\Model\Entity\Notificaco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificacoesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $notificacoes = $this->paginate($this->Notificacoes);

        $this->set(compact('notificacoes'));
    }

    /**
     * View method
     *
     * @param string|null $id Notificaco id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($this->request->is(['post'])) {
            if ($this->request->data['usuario_id']) {
                $this->loadModel('Agendamentos');
                $aAgendamentos = $this->Agendamentos->find('all')
                    ->select('id')
                    ->where(['usuario_id' => $this->request->data['usuario_id']])
                    ->toArray();

                $sAgendamentosIds = '0';
                foreach ($aAgendamentos as $id) {
                    $sAgendamentosIds .= ', ' . $id->id;
                }
                $conditions = 'agendamento_id IN (' . $sAgendamentosIds . ')';

                $aNotificacoes = $this->Notificacoes->find('all')
                    ->where([$conditions])
                    ->toArray();

                $this->set('notificacoes', $aNotificacoes);
            }
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificaco = $this->Notificacoes->newEntity();
        if ($this->request->is('post')) {
            $notificaco = $this->Notificacoes->patchEntity($notificaco, $this->request->getData());
            if ($this->Notificacoes->save($notificaco)) {
                $this->Flash->success(__('The notificaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notificaco could not be saved. Please, try again.'));
        }
        $this->set(compact('notificaco'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notificaco id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notificaco = $this->Notificacoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificaco = $this->Notificacoes->patchEntity($notificaco, $this->request->getData());
            if ($this->Notificacoes->save($notificaco)) {
                $this->Flash->success(__('The notificaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notificaco could not be saved. Please, try again.'));
        }
        $this->set(compact('notificaco'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notificaco id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificaco = $this->Notificacoes->get($id);
        if ($this->Notificacoes->delete($notificaco)) {
            $this->Flash->success(__('The notificaco has been deleted.'));
        } else {
            $this->Flash->error(__('The notificaco could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
