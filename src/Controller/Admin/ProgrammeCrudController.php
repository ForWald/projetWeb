<?php

namespace App\Controller\Admin;

use App\Entity\Programme;
use App\Entity\Niveau;
use App\Entity\Objectif;
use App\Entity\Seance;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProgrammeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Programme::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('nomProgramme'),
        AssociationField::new('niveau'),
        AssociationField::new('objectif'),
        BooleanField::new('halteres'),
        AssociationField::new('frequence'),
        CollectionField::new('ordreSeances')->allowAdd()->useEntryCrudForm()->setLabel('Seance'),
        ];
    }
    
}
