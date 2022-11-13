<?php

namespace App\Controller\Admin;

use App\Entity\Persona;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PersonaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Persona::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
