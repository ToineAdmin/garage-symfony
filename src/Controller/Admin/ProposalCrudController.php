<?php

namespace App\Controller\Admin;

use App\Entity\Proposal;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
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
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

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

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        $uow = $em->getUnitOfWork();
        $uow->computeChangeSets();
        $changeset = $uow->getEntityChangeSet($entityInstance);

        parent::updateEntity($em, $entityInstance);

        if (isset($changeset['status'])) {
            $this->sendStatusChangeEmail($entityInstance);
        }
    }

    private function sendStatusChangeEmail(Proposal $proposal)
    {
        $status = $proposal->getStatus();

        switch ($status) {
            case 'refusé':
                $subject = 'Votre proposition a été refusée';
                $template = 'emails/statusRefused.html.twig';
                break;
            case 'accepté':
                $subject = 'Votre proposition a été acceptée';
                $template = 'emails/statusAccepted.html.twig';
                break;
            default:
                $subject = 'Mise à jour de votre proposition d\'achat';
                $template = 'emails/statusDefault.html.twig';  
        }

        $email = (new TemplatedEmail())
            ->from('garage-parrot@gmail.com')
            ->to($proposal->getEmail())
            ->subject($subject)
            ->htmlTemplate($template)
            ->context([
                'status' => $status,
                'carName' => $proposal->getCar()->getName(),
                'initialPrice' => $proposal->getCar()->getPrice(),
                'proposedPrice' => $proposal->getProposedPrice()
            ]);

        $this->mailer->send($email);
    }
}
