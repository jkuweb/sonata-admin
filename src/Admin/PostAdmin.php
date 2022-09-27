<?php 

namespace App\Admin;

use App\Entity\Post;
use App\Entity\Category;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        $list
            ->addIdentifier('title')
            ->add('category.name')
            ->add('draft')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        /*
         add(4argumentos):
            string $name,
            ?string $type = null,
            array $filterOptions = [],
            array $fieldDescriptionOptions = []
        */    

        $datagrid
            ->add('title')
            ->add('category', null, [
                'field_type' => EntityType::class,
                'field_options' => [
                    'class' => Category::class,
                    'choice_label' => 'name'
                ],
            ])
        ;    
    }
    
    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->tab('Post')
                ->with('Content', ['class' => 'col-md-9'])
                    ->add('id')
                    ->add('title')
                    ->add('body')
                ->end()    
                ->with('Meta data', ['class' => 'col-md-3'])
                    ->add('category.name')
                ->end()
            ->end()
            ->tab('Publish Options')
            ->end()        
        ;
    }

    public function toString($object): string
    {
        return $object instanceof Post
            ? $object->getTitle()
            : 'Post';
    }
}
