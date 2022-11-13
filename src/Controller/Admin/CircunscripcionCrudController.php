<?php

namespace App\Controller\Admin;

use App\Entity\Circunscripcion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CircunscripcionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Circunscripcion::class;
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
