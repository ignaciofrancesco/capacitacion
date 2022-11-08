<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true, // render check-boxes
                'label' => 'Rol',
                'choices' => [
                    'Consultor' => 'ROLE_CONSULTOR',
                    'Editor' => 'ROLE_EDITOR',
                    'Administrador' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN'
                ]
            ])
            ->add('password')
            ->add('dni')
            ->add('apellido')
            ->add('nombre')
            ->add('email')
            ->add('fechaAlta')
            ->add('fechaBaja')
            ->add('ultimoAcceso')
            ->add('cantidadAccesos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
