<?php

namespace App\Form;

use App\Entity\Incidente;
use App\Entity\Coche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tipo_incidente')
            // ->add('coches_incidente', ChoiceType::class, [
            //     'multiple' => true,
            // ])
            ->add('coches_incidente_2', EntityType::class, [
                'class' => Coche::class,
                'choice_label' => 'matricula',
                'multiple' => true,
            ])
            ->add('descripcion')
            ->add('usuario');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incidente::class,
        ]);
    }
}
