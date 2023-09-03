<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    /**
     * Configure les groupes de validation pour l'entité en cours de traitement.
     * 
     * Si l'entité est nouvelle (n'a pas d'ID), les groupes "Default" et "Creation" sont utilisés.
     * Sinon, pour une entité existante (en cours de modification), les groupes "Default" et "Edition" sont utilisés.
     * 
     * @param AdminContext $context Le contexte d'administration actuel.
     * @return array Les groupes de validation à utiliser pour l'entité.
     */
    public function configureValidationGroups(AdminContext $context): array
    {
        $entity = $context->getEntity();

        if ($entity->getInstance()->getId() === null) {

            return ['Default', 'Creation'];
        }


        return ['Default', 'Edition'];
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('email', 'Email'),
            TextField::new('Lastname', 'Nom de famille'),
            TextField::new('Firstname', 'Prénom'),
            TextField::new('plainPassword', 'Mot de passe')
                ->onlyWhenCreating()
                ->setRequired(false)
                ->setHelp('Laisser vide si vous ne souhaitez pas le changer'),
            TextField::new('job', 'Métier'),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setFormTypeOptions([
                    "multiple" => false,
                    "attr" => [
                        "accept" => "image/x-png,image/gif,image/jpeg"
                    ],
                ])
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(true),
            TextareaField::new('description', 'Description')

        ];
    }
}
