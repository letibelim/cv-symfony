<?php
/**
 * Created by PhpStorm.
 * User: tlegrand
 * Date: 25/07/18
 * Time: 17:39
 */

namespace App\Form;


use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => false,
                'label'  => 'Votre nom',
                'attr' => ['placeholder' => 'Clark Kent' ],
                ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label'  => 'Votre email',
                'attr' => ['placeholder' => 'clark.kent@kripton.com' ],
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label'  => 'Votre message',
                'attr' => ['placeholder' => "Venez m'aider à sauver le monde" ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Envoyez !'])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}