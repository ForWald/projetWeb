<?php

namespace App\Controller\Admin;

use App\Entity\Niveau;
use App\Entity\Seance;
use App\Entity\Objectif;
use App\Entity\Programme;
use Doctrine\ORM\QueryBuilder;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
        TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
        TextField::new('imageFile')->setFormType(VichImageType::class)->onlyWhenUpdating(),
        ImageField::new('imageName')->setBasePath('/images/programme')->onlyOnIndex()->setLabel('Image'),
        CollectionField::new('ordreSeances')->allowAdd()->useEntryCrudForm()->setLabel('Seance'),
        ];
    }
    
}
