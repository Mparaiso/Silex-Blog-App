<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', "text", array("constraints" => array(new Assert\NotBlank(), new Assert\MinLength(5)), "attr" => array("placeholder" => "name")));
        $builder->add('email', "email", array("constraints" => array(new Assert\NotBlank(), new Assert\Email()), "attr" => array("placeholder" => "email")));
        $builder->add('firstname', "text", array("constraints" => array(new Assert\NotBlank(), new Assert\MinLength(3))));
        $builder->add('lastname', "text", array("constraints" => array(new Assert\NotBlank(), new Assert\MinLength(3))));
        $builder->add('password_repeated', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'The password fields must match.',
            'options' => array('required' => true),
            'first_options' => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ));
        $builder->add("agreement", 'checkbox', array('label' => "I agree with the condition of use"));
    }

    public function getName() {
        return "register";
    }

}