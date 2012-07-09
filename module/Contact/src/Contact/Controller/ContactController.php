<?php

namespace Contact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contact\Model\Contact;
use Contact\Form\ContactForm;

class ContactController extends AbstractActionController
{
    protected $contactTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'contacts' => $this->getContactTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ContactForm();
        $form->get('submit')->setAttribute('value', 'Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $contact = new Contact();
            $form->setInputFilter($contact->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $contact->exchangeArray($form->getData());
                $this->getContactTable()->saveContact($contact);

                // Redirect to list of contacts
                return $this->redirect()->toRoute('contact');
            }
        }

        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('contact', array('action'=>'add'));
        }
        $contact = $this->getContactTable()->getContact($id);

        $form = new ContactForm();
        $form->bind($contact);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getContactTable()->saveContact($contact);

                // Redirect to list of contacts
                return $this->redirect()->toRoute('contact');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('contact');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int)$request->getPost()->get('id');
                $this->getContactTable()->deleteContact($id);
            }

            // Redirect to list of contacts
            return $this->redirect()->toRoute('contact');
        }

        return array(
            'id' => $id,
            'contact' => $this->getContactTable()->getContact($id)
        );
    }

    public function getContactTable()
    {
        if (!$this->contactTable) {
            $sm = $this->getServiceLocator();
            $this->contactTable = $sm->get('contact-table');
        }
        return $this->contactTable;
    }    
}
