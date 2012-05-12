<?php
namespace Contact\Form;

use Zend\Form\Form,
    Zend\Form\Element;

class ContactForm extends Form
{
    public function init()
    {
        $this->setName('contact');

        $id = new Element\Hidden('id');
        $id->addFilter('Int');

        $forename = new Element\Text('forename');
        $forename->setLabel('Forename')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $surname = new Element\Text('surname');
        $surname->setLabel('Surname')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $nickname = new Element\Text('nickname');
        $nickname->setLabel('Nickname')
              ->addFilter('StripTags')
              ->addFilter('StringTrim');

        $category = new Element\Text('category');
        $category->setLabel('Category')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $submit = new Element\Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $forename, $surname, $nickname, $category, $submit));
    }
}
