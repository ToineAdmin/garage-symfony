<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use Symfony\Component\Validator\Constraints\Range;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function createEntity(string $entityFqcn) // passe User directement dans createdBy pour éviter l'ajout d'un input pré rempli inutile
    {
        $car = new Car();
        $car->setCreatedBy($this->getUser());
        $car->setCaracteristics('Longueur :
Largeur :
Hauteur :
Empattement :
Volume coffre :
Nombre de porte :');
        $car->setEquipements('Climatisation :
Eco consommation :
Mode sport :
Bluetooth :');

        return $car;
    }


    public function configureFields(string $pageName): iterable
    {
        //rajouter le champ user_id prérempli
        return [
            TextField::new('name', 'Titre'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextField::new('brand', 'Marque'),
            TextField::new('fuel', 'Carburant'),
            IntegerField::new('year', 'Année')
            ->setFormTypeOptions([
                'attr' => [
                    'min' => 1995,
                    'max' => date('Y')
                ],
                'constraints' => [
                    new Range([
                        'min' => 1995,
                        'max' => date('Y'),
                        'minMessage' => 'L\'année ne peut pas être inférieure à {{ limit }}.',
                        'maxMessage' => 'L\'année ne peut pas être supérieure à {{ limit }}.',
                    ])
                ]
                ]),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setFormTypeOptions([
                    "multiple" => true,
                    "attr" => [
                        "accept" => "image/x-png,image/gif,image/jpeg"
                    ],
                ])
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            IntegerField::new('miles', 'Kilométrage'),
            TextareaField::new('description', 'Description'),
            TextareaField::new('caracteristics', 'Caractéristiques'),
            TextareaField::new('equipements', 'Equipements')
        ];
    }
}
