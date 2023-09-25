<?php

    namespace App\Controller\Admin;

    use App\Entity\Proposal;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
    use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
    use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
    use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
    use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
    use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
    use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
    use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

    class ProposalCrudController extends AbstractCrudController
    {
        public static function getEntityFqcn(): string
        {
            return Proposal::class;
        }

        public function configureFields(string $pageName): iterable
        {
            $fields = [
                AssociationField::new('car', 'Voiture')->onlyOnIndex(),
                EmailField::new('email', 'Email')->onlyOnIndex(),
                MoneyField::new('proposedPrice', 'Prix proposé')
                    ->setCurrency('EUR')
                    ->setStoredAsCents(false)
                    ->onlyOnIndex(),
                TextareaField::new('comment', 'Commentaire')->onlyOnIndex(),
                ChoiceField::new('status', 'Statut')
                    ->setChoices([
                        'En attente' => 'en attente',
                        'Accepté' => 'accepté',
                        'Refusé' => 'refusé'
                    ])
                    ->allowMultipleChoices(false)
                    ->renderExpanded(false)
                    ->setColumns('col-md-3')
            ];

            if ($pageName === Crud::PAGE_EDIT) {
                return [
                    ChoiceField::new('status', 'Statut')
                        ->setChoices([
                            'En attente' => 'en attente',
                            'Accepté' => 'accepté',
                            'Refusé' => 'refusé'
                        ])
                ];
            }

            return $fields;
        }

        public function configureActions(Actions $actions): Actions
        {
            return $actions
                ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                    return $action->setLabel('Modifier le statut');
                });
        }
    }
