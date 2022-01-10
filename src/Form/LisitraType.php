<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Lisitra;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LisitraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, 
            [
                'label' => 'Nom',
                'constraints' => new NotBlank(['message' => 'Entrer votre nom'])
            ])
            ->add('country', EntityType::class, 
            [
                'label' => 'Pays',
                'class'=> Country::class,
                'choice_label'=> 'name',
                'placeholder'=> 'Selectionner un pays',
                'query_builder'=> fn(CountryRepository $countryRepository) => $countryRepository->createQueryBuilder('c')->orderBy('c.name', 'ASC'),
                'required' => false
                ])

                ->add('city', ChoiceType::class, 
                [
                    'label' => 'Ville',
                    'placeholder'=> 'Selectionner une ville',
                    'required' => false,
                ])
             ->add('message', TextareaType::class,
            [
                'constraints' => 
                [
                    new NotBlank(['message' => 'Entrer votre message']),
                    new Length(['min' => 5, 'minMessage' => 'il faut au moins 5 caractères'])
                ]
                
            ])
        ;

        $formModifier = function (FormInterface $form, Country $country = null) 
        {
            $city = (null === $country) ? [] : $country->getCities();

            $form->add('city', EntityType::class, 
            [
                'class' => City::class,
                'choices' => $city,
                'required' => false,
                'choice_label' => 'name',
                'attr' => ['class' => 'custom-select'],
                'query_builder'=> fn (CityRepository $cityRepository) => $cityRepository->createQueryBuilder('c')->orderBy('c.name', 'ASC'),
            ]);
        };

        $builder->get('country')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) 
            {
                $country = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $country);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lisitra::class,
        ]);
    }
}
