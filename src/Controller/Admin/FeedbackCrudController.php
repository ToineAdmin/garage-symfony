<?php

namespace App\Controller\Admin;

use App\Entity\Feedback;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FeedbackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Feedback::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Prénom'),
            TextareaField::new('comment', 'Commentaire'),
            IntegerField::new('rating', 'Note')
                ->setHelp('Note entre 0 sur 5'),
            BooleanField::new('approved', 'Approuvé'),
            DateTimeField::new('createdAt', 'Envoyé le')->onlyOnDetail()
        ];
    }
    
}
