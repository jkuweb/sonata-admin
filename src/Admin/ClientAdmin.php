<?php

namespace App\Admin;

use App\Entity\Client;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ClientAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Producto', ['class' => 'col-md-9'])
                ->add('name', TextType::class)
                ->add('firstname', TextType::class)
            ->end()    
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
    }

    protected function configureListFields(ListMapper $list): void
    {
        /* https://docs.sonata-project.org/projects/SonataAdminBundle/en/4.x/reference/field_types/ */
        $list
            ->addIdentifier('name', null, ['label' => 'Nombre'])
            ->add(ListMapper::NAME_ACTIONS, null, [
                    'actions' => [
                        'show' => [],
                        'edit' => [],
                        'delete' => []
                    ],
                    'label' => 'Acciones'
                ])
           ; 
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('name')
            ->add('firstName')
        ;    
    }

    public function toString($object): string
    {
        return $object instanceof Client
            ? $object->getName()
            : 'Cliente';
    }
}
