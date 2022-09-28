<?php

namespace App\Admin;

use App\Entity\Product;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('price', IntegerType::class)
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
            ->add('price', 'currency', [
                    'currency' => 'EUR',
                    'label' => 'Precio',
                    'editable' => true
                ])
            ->add('description')    
            ->add('createdAt', null, [
                    'format' => 'd-m-Y H:i',
                    'timezone' => 'Europe/Madrid',
                    'label' => 'Fecha'
                 ])
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
            ->add('description')
            ->add('price')
            ->add('createdAt')
        ;    
    }

    public function toString($object): string
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Producto';
    }
}
