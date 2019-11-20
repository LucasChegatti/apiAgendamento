<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Model\Entity\Usuario;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Utility\Security;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsuariosController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login']);
    }


    /**
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function login()
    {
        if ($this->request->is(['post'])) {

            $user = $this->Auth->identify();

            if($user){
                $this->Auth->setUser($user);
                $this->set([ 
                    'success' => true,
                    'data' => [
                        'token' => $token = \Firebase\JWT\JWT::encode([
                            'sub' => $user['cpf'],
                            'exp' => time() + 360000,
                        ], Security::salt()),
                        'perfil' => $user['perfil_id']
                    ],
                ]);
                
                $this->loadModel('Logins');
                $logins = $this->Logins->newEntity();
                $logins->data_hora = date('Y-m-d H:i:s');
                $logins->usuario_id = $user['id'];
                $logins->token = $token;
                $logins = $this->Logins->save($logins);

                $this->set('_serialize' , ['success', 'data']);
                return;
            }            
        }

        $this->response = $this->response->withStatus(400);
        $message = 'Usuário ou senha inválidos';
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
        return;
    }

    public function LoginOut()
    {
        $this->Auth->logout();
        $message = 'Usuário deslogado com sucesso.';
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
        return;
    }
}
