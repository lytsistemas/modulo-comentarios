<?php

namespace Comentario\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class ComentarioTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getComentario($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveComentario(Comentario $comentario)
    {
        $data = [
            'comentario' => $comentario->comentario,
            'post'  => $comentario->post,
        ];

        $id = (int) $comentario->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getComentario($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update comentario with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteComentario($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
