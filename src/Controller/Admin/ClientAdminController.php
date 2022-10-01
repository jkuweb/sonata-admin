<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientAdminController extends CRUDController
{
    public function sendEmailAction($id): Response
    {
        $client = $this->admin->getSubject();
        $clientEmailAddress = $client->getEmail();
        // send email
        $this->addFlash('sonata_flash_success', 'Email enviado existosamente');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}
