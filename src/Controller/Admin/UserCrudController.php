<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserCrudController extends AbstractCrudController
{
   
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('utilisateur');
    }
    
    
    public function configureFields(string $pageName): iterable
    {
        $rolesField = ChoiceField::new('roles')
            ->setLabel('Rôles')
            ->setChoices([
                'Utilisateur'=>'ROLE_USER',
                'Coach' => 'ROLE_COACH',
                'Administrateur' => 'ROLE_ADMIN',
    ])
            ->setRequired(true)
            ->allowMultipleChoices();
    

        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            $rolesField,
            
        ];
    }
}


