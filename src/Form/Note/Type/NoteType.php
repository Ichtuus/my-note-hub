<?php

namespace App\Form\Note\Type;

use App\Entity\Note\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note_title')
            ->add('note_content')
            ->add('note_first_link')
            ->add('note_second_link')
            ->add('note_third_link');
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Note::class,
            'csrf_protection'    => false,
            'allow_extra_fields' => true,
        ]);
    }
}
