<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Pfe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PfeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomEtudiant')
            ->add('title')
            ->add('Entreprise',EntityType::class,[
                'class' => Entreprise::class ,
                'choice_label'=>'Designation',
                'expanded'=>false,
                'multiple'=>false])
            ->add("Subimit",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pfe::class,
        ]);
    }
}
