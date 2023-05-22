<?php

namespace App\Form;

use App\Entity\Schedule;
use App\Enum\DaysEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noonTimeStart', TimeType::class)
            ->add('noonTimeEnd', TimeType::class)
            ->add('eveningTimeStart', TimeType::class)
            ->add('eveningTimeEnd', TimeType::class)
            ->add('isOpen', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
            'csrf_protection' => false
        ]);
    }
}
