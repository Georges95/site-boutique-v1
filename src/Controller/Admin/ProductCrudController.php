<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom')->setHelp('Nom du produit'),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('name')->setHelp('URL du produit générée automatiquement'),
            TextEditorField::new('description')->setLabel('Description')->setHelp('Description du produit'),
            ImageField::new('illustration')->setBasePath('uploads/')->setUploadDir('public/uploads/')->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')->setLabel('Image')->setHelp('Image du produit en 600x600px'),
            NumberField::new('price')->setLabel('Prix H.T')->setHelp('Prix H.T du produit sans le sigle €'),
            ChoiceField::new('tva')->setLabel('Taux de TVA')->setChoices([
                '5.5%' => '5.5',
                '10%' => '10',
                '20%' => '20',                
            ]),
            AssociationField::new('category', 'catégories associée'),
            
        ];
    }
    
}