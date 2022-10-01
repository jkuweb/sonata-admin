<?php

namespace App\Admin;

use App\Entity\Client;
use App\Entity\Address;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;

class ClientAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollectionInterface $collection): void 
    {
        $collection
            ->add('send-email', $this->getRouterIdParameter(). '/send-email');
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Cliente', ['class' => 'col-md-9'])
                ->add('name', TextType::class, ['label' => 'Nombre'])
                ->add('firstname', TextType::class, ['label' => 'Apellido'])
                ->add('email', TextType::class, ['label' => 'Email'])
                ->add('address', ModelListType::class, ['label' => 'Dirección'])
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
            ->add('firstName', null, ['label' => 'Apellido'])
            ->add('email', null, ['label' => 'Email'])
            ->add(ListMapper::NAME_ACTIONS, null, [
                    'actions' => [
                        'show' => [],
                        'edit' => [],
                        'delete' => [],
                        'email' => [
                            'template' => 'admin/client/list__action_email.html.twig'
                        ]
                    ],
                    'label' => 'Acciones'
            ])
           ; 
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->tab('Información')
                ->with('Cliente', ['class' => 'col-md-9'])
                    ->add('name')
                    ->add('firstName')
                    ->add('email')
                ->end()    
            ->end()
            ->tab('Direccion')    
                ->with('Direccion', ['class' => 'col-md-9'])
                    ->add('address.street', EntityType::class, ['label' => 'Dirección'])
                    ->add('address.cp', EntityType::class, ['label' => 'Código Postal'])
                    ->add('address.phoneNumber', EntityType::class, ['label' => 'Nº de teléfono'])
                    ->add('address.country', EntityType::class, ['label' => 'Estado'])
                ->end()    
            ->end()
            ->tab('Pedidos')
                ->add('orders', null, [
                    'associated_property' => 'id',
                    'label' => 'Lista de pedidos'
                ])
            ->end()
        ;    
    }

    public function toString($object): string
    {
        return $object instanceof Client
            ? $object->getName()
            : 'Cliente';
    }
}
