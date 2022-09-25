<?php 

namespace App\Admin;

use App\Entity\Category;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class PostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Contenido', ['class' => 'col-md-9'])
                ->add('title', TextType::class)
                ->add('body', TextareaType::class)
            ->end()
            ->with('Meta data', ['class' => 'col-md-3'])    
                ->add('category', ModelType::class, [
                    'class' => Category::class,
                    'property' => 'name'
                ])
            ->end()
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        // ... configure $list
    }
}
