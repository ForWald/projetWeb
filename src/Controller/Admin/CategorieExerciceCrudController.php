<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use App\Entity\CategorieExercice;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\QueryBuilder;


class CategorieExerciceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieExercice::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('categorie')->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Categorie::class)->findAll()),
        ];
    }
    
}
