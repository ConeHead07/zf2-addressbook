<?php
namespace Contact\Form;

use Zend\Form\Form;

class ContactForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setName('contact');
        $this->setAttribute('method', 'post');

        // Id
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        // Surname        
        $this->add(array(
            'name' => 'surname',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Surname',
            ),
        ));

        $this->add(array(
            'name' => 'forename',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Forename',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}
