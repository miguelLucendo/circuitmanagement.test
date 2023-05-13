<?php

namespace App\Form;

use App\Entity\Reserva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('hora_inicio', ChoiceType::class, [
                'choices' => [
                    '08:00' => '08:00',
                    '09:00' => '09:00',
                    '10:00' => '10:00',
                    '11:00' => '11:00',
                    '12:00' => '12:00',
                    '13:00' => '13:00',
                    '14:00' => '14:00',
                    '18:00' => '18:00',
                    '19:00' => '19:00',
                    '20:00' => '20:00',
                ],
            ])
            ->add('coche')
            ->add('usuario');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
