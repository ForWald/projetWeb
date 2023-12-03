<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Niveau;
use App\Entity\Seance;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SeanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Seance::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $className = $this->getEntityFqcn();
        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);
        $someRepository = $entityManager->getRepository(Categorie::class);
        return [
            TextField::new('nom'),
            AssociationField::new('niveau')->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Niveau::class)->findAll()),
            AssociationField::new('categorie')->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Categorie::class)->findAll()),

         //   IntegerField::new('nb_series'),
            CollectionField::new('ordreExercices')->allowAdd()->useEntryCrudForm()->setLabel('Exercices'),

        ];
    }

}
