<?php 

namespace App\Admin;

use App\Entity\Address;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

final class AddressAdmin extends AbstractAdmin
{
    /* similar a como funciona Form en sf */
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('street', TextType::class, ['label' => 'calle'])
            ->add('cp', NumberType::class, ['label' => 'codigo postal'])
            ->add('phoneNumber', NumberType::class, ['label' => 'nº de teléfono'])
            ->add('country', null, ['label' => 'Estado']);
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
        $show->add('street');
    }

    public function toString($object): string
    {
        return $object instanceof Address
            ? $object->getStreet()
            : 'Dirección';
    }
}