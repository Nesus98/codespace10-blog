<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Entrada;
use App\Entity\Etiqueta;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EntradaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextType::class, [
                'label' => 'Título',
                'required' => true,
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('estado', ChoiceType::class, [
                'choices' => [
                    'En elaboracion' => 0,
                    'Publicada' => 1
                ]
            ])
            ->add('resumen', TextareaType::class, [
                'attr' => [
                    'rows' => 4,
                    'placeholder' => 'Escribe aqui el resumen'
                ]
            ])
            ->add('texto', TextareaType::class, [
                'attr' => ['class' => 'richeditor']
            ])
            ->add('entradas')
            ->add('categoria', EntityType::class, [
                'label' => 'Categoria',
                'class' => Categoria::class
            ])
            ->add('etiquetas', EntityType::class, [
                'class' => Etiqueta::class,
                'label' => 'Seleccione las etiquetas vinculadas',
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
