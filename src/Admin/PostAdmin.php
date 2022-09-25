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
            ->add('title', TextType::class)
            ->add('body', TextareaType::class)
            ->add('category', ModelType::class, [
                'class' => Category::class,
                'property' => 'name'
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        // ... configure $list
    }
}
