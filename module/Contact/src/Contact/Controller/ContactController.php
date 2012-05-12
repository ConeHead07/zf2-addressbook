<?php

namespace Contact\Controller;

use Zend\Mvc\Controller\ActionController,
    Contact\Model\ContactTable,
    Contact\Form\ContactForm,
    Zend\View\Model\ViewModel;

class ContactController extends ActionController
{
    /**
     * @var \Contact\Model\ContactTable
     */
    protected $contactTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'contacts' => $this->contactTable->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ContactForm();
        $form->submit->setLabel('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->post()->toArray();
            if ($form->isValid($formData)) {
                $forename = $form->getValue('forename');
                $surname  = $form->getValue('surname');
                $nickname  = $form->getValue('nickname');
                $category  = $form->getValue('category');
                $this->contactTable->addContact($forename, $surname, $nickname, $category);

                // Redirect to list of contacts
                return $this->redirect()->toRoute('default', array(
                    'controller' => 'contact',
                    'action'     => 'index',
                ));

            }
        }

        return array('form' => $form);

    }

    public function editAction()
    {
        $form = new ContactForm();
        $form->submit->setLabel('Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->post()->toArray();
            if ($form->isValid($formData)) {
                $id     = $form->getValue('id');
                $forename = $form->getValue('forename');
                $surname  = $form->getValue('surname');
                $nickname  = $form->getValue('nickname');
                $category  = $form->getValue('category');
                
                if ($this->contactTable->getContact($id)) {
                    $this->contactTable->updateContact($id, $forename, $surname, $nickname, $category);
                }

                // Redirect to list of contacts
                return $this->redirect()->toRoute('default', array(
                    'controller' => 'contact',
                    'action'     => 'index' ,
                ));
            }
        } else {
            $id = $request->query()->get('id', 0);
            if ($id > 0) {
                $contact = $this->contactTable->getContact($id);
                if ($contact) {
                    $form->populate($contact->getArrayCopy());
                }
            }
        }

        return array('form' => $form);
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = $request->post()->get('id');
                $this->contactTable->deleteContact($id);
            }

            // Redirect to list of contacts
            return $this->redirect()->toRoute('default', array(
                'controller' => 'contact',
                'action'     => 'index',
            ));
        }

        $id = $request->query()->get('id', 0);
        return array('contact' => $this->contactTable->getContact($id));        
    }

    public function setContactTable(ContactTable $contactTable)
    {
        $this->contactTable = $contactTable;
        return $this;
    }    
}
