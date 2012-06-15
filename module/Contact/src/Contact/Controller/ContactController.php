<?php

namespace Contact\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Contact\Model\ContactTable,
    Contact\Model\Contact,
    Contact\Form\ContactForm;

class ContactController extends ActionController
{
    /**
     * @var \Contact\Model\ContactTable
     */
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
            $form->setData($request->post());
            if ($form->isValid()) {

                $contact->populate($form->getData());
                $this->getContactTable()->saveContact($contact);

                // Redirect to list of contacts
                return $this->redirect()->toRoute('contact');

            }
        }

        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('contact', array('action'=>'add'));
        }
        $contact = $this->getContactTable()->getContact($id);

        $form = new ContactForm();
        $form->setBindOnValidate(false);
        $form->bind($contact);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->post());
            if ($form->isValid()) {
                $form->bindValues();
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
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('contact');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->post()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int)$request->post()->get('id');
                $this->getContactTable()->deleteContact($id);
            }

            // Redirect to list of contacts
            return $this->redirect()->toRoute('default', array(
                'controller' => 'contact',
                'action'     => 'index',
            ));
        }

        return array(
            'id' => $id,
            'contact' => $this->getContactTable()->getContact($id)
        );
    }

    public function setContactTable(ContactTable $contactTable)
    {
        $this->contactTable = $contactTable;
        return $this;
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
