<?php

namespace App\Controller\Admin;

use App\Entity\Car;
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

        return $car;
    }

    
    public function configureFields(string $pageName): iterable
    {
        //rajouter le champ user_id prérempli
        return [
            TextField::new('name', 'Titre'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            TextField::new('brand', 'Marque'),
            DateField::new('year', 'Date de mise en circulation')
            ->setFormTypeOption('widget', 'single_text')
            ->setFormTypeOption('html5', false) // Utilise le format "d-m-Y" (jour-mois-année)
            ->setFormat('MMMM yyyy') // Format d'affichage mois-année (en utilisant IntlDateFormatter)
            ->setRequired(false)
            ->setTimezone('Europe/Paris'), // Définir le fuseau horaire si nécessaire
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
