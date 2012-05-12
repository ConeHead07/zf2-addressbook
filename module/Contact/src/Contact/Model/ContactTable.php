<?php

namespace Contact\Model;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

class ContactTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, 
        ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('contact', $adapter, $databaseSchema, 
            $selectResultPrototype);
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getContact($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function addContact($forename, $surname, $nickname, $category)
    {
        $data = array(
            'forename' => $forename,
            'surname'  => $surname,
            'nickname'  => $nickname,
            'category'  => $category,
        );
        $this->insert($data);
    }

    public function updateContact($id, $forename, $surname, $nickname, $category)
    {
        $data = array(
            'forename' => $forename,
            'surname'  => $surname,
            'nickname'  => $nickname,
            'category'  => $category,
        );
        $this->update($data, array('id' => $id));
    }

    public function deleteContact($id)
    {
        $this->delete(array('id' => $id));
    }

}
