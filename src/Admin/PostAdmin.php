<?php 

namespace App\Admin;

use App\Entity\Post;
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
            ->tab('Post')
                ->with('Contenido', ['class' => 'col-md-9'])
                    ->add('title', TextType::class)
                    ->add('body', TextareaType::class)
                ->end()
            ->end()
            ->tab('Publish Options')    
                ->with('Meta data', ['class' => 'col-md-3'])    
                    ->add('category', ModelType::class, [
                        'class' => Category::class,
                        'property' => 'name'
                    ])
                ->end()
            ->end()    
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        // ... configure $list
    }

    public function toString($object): string
    {
        return $object instanceof Post
            ? $object->getTitle()
            : 'Post';
    }
}
