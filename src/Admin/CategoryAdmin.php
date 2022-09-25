<?php 

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{
    /* similar a como funciona Form en sf */
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name', TextType::class);
    }
    /* configura los filtros(filtrar y clasificar)*/
    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
    }
    /* configura que campos se muestran cuando todos los modelos son listados */
    protected function configureListFields(ListMapper $list): void
    {
        /* addIdentifier se muestra como un link que redirige(mostrar/editar) */
        $list->addIdentifier('name');
    }
    /* configura que campos se van a mostrar en la vista */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('name');
    }
}