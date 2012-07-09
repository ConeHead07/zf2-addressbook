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
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'forename',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Forename',
            ),
        ));

        $this->add(array(
            'name' => 'surname',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Surname',
            ),
        ));

        $this->add(array(
            'name' => 'nickname',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Nickname',
            ),
        ));

        $this->add(array(
            'name' => 'category',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Category',
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
