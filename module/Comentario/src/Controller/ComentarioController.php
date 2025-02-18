<?php

namespace Comentario\Controller;

use Comentario\Model\ComentarioTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

use Comentario\Form\ComentarioForm;
use Comentario\Model\Comentario;

class ComentarioController extends AbstractActionController
{
    
    private $table;

    public function __construct(ComentarioTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'comentarios' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new ComentarioForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $comentario = new Comentario();
        $form->setInputFilter($comentario->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $comentario->exchangeArray($form->getData());
        $this->table->saveComentario($comentario);
        return $this->redirect()->toRoute('comentario');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
    
        if (0 === $id) {
            return $this->redirect()->toRoute('comentario', ['action' => 'add']);
        }
    
        try {
            $comentario = $this->table->getComentario($id);
        } catch (\Exception $e) {
            echo "Error al encontrar el comentario: " . $e->getMessage() . "\n";
            return $this->redirect()->toRoute('comentario', ['action' => 'index']);
        }
    
        $form = new ComentarioForm();
        $form->bind($comentario);
        $form->get('submit')->setAttribute('value', 'Edit');
    
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
    
        if (! $request->isPost()) {
            return $viewData;
        }
    
        $form->setInputFilter($comentario->getInputFilter());
        $form->setData($request->getPost());
    
        if (! $form->isValid()) {
            echo "Formulario no válido\n";
            return $viewData;
        }
    
        $comentario->exchangeArray($form->getData()->getArrayCopy());
        $this->table->saveComentario($comentario);
        return $this->redirect()->toRoute('comentario', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('comentario');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteComentario($id);
            }

            // Redirect to list of comentario
            return $this->redirect()->toRoute('comentario');
        }

        return [
            'id'    => $id,
            'comentario' => $this->table->getComentario($id),
        ];
    }
}
