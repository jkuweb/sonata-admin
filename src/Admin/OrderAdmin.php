<?php 

namespace App\Admin;

use App\Entity\Client;
use App\Entity\Product;
use App\Entity\ClientOrder;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class OrderAdmin extends AbstractAdmin
{
    /* similar a como funciona Form en sf */
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('products', ModelType::class, [
                'multiple' => true,
                'property' => 'name',
                'btn_add' => true,
                'expanded' => true
            ])
            ->add('client', ModelType::class, [
                'property' => 'FullName',
                'btn_add' => true,
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('client.fullName',EntityType::class, ['label' => 'Cliente'])
            ->add('products', EntityType::class, [
                'associated_property' => 'name',
                'label' => 'Lista de productos'
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
            ->add('id')
            ->add('client.fullName', EntityType::class, [ 'label' => 'Cliente' ])
            ->add('products', null, [
                'associated_property' => 'name',
                'label' => 'Lista de productos'
            ])
        ;    
    }

    public function toString($object): string
    {
        return $object instanceof ClientOrder
            ? $object->getId()
            : 'pedidio';
    }
}