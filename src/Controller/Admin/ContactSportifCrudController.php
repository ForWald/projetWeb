<?php

namespace App\Controller\Admin;

use App\Entity\ContactSportif;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactSportifCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactSportif::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->disable(Action::NEW, Action::NEW);
    }
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            TextField::new('subject')->setLabel('Objet'),
            TextField::new('message'),

        ];


    }
}
