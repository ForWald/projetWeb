<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use App\Entity\CategorieExercice;
use App\Entity\Categorie;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExerciceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercice::class;
    }

    
    
    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('nom'),
            TextEditorField::new('description'),
            TextField::new('video'),
            TextEditorField::new('descriptionSiHaltere'),
            TextField::new('videoSiHaltere'),
            CollectionField::new('categorieExercices')->allowAdd()->useEntryCrudForm()->setLabel('CategorieExercice'),

        ];
    }

    
}
