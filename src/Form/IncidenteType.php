<?php

namespace App\Form;

use App\Entity\Incidente;
use App\Entity\Coche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class IncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descripcion', TextAreaType::class)
            ->add('tipo_incidente')
            ->add('coches', EntityType::class, [
                'class' => Coche::class,
                'choice_label' => 'matricula',
                'multiple' => true,
                'required' => false,
                'mapped' => false,
            ])
            ->add('usuario');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incidente::class,
        ]);
    }
}
