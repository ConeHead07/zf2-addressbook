<?php

namespace Contact\Model;

use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

class ContactTable extends AbstractTableGateway
{
    protected $table ='contact';
    protected $tableName ='contact';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Contact);

        $this->initialize();
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

    public function saveContact(Contact $contact)
    {
        $data = array(
            'surname' => $contact->surname,
            'forename'  => $contact->forename,
        );

        $id = (int)$contact->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getContact($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exit');
            }
        }
    }

    public function addContact($surname, $forename)
    {
        $data = array(
            'surname' => $surname,
            'forename'  => $forename,
        );
        $this->insert($data);
    }

    public function updateContact($id, $surname, $forename)
    {
        $data = array(
            'surname' => $surname,
            'forename'  => $forename,
        );
        $this->update($data, array('id' => $id));
    }

    public function deleteContact($id)
    {
        $this->delete(array('id' => $id));
    }

}
