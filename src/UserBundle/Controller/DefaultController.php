<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    public function adminAction()
    {
        return $this->render('@User/Default/dashboard.html.twig');
    }

    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $results = $qb->select('e')
            ->from('KidzyBundle:Facture', 'e')
            ->where('e.dateFacture >= :dateFacture')
            ->setParameter('dateFacture', new \DateTime('-48 hours'))
            ->getQuery()
            ->getResult();

        return $this->render('@User/Default/notifications.html.twig',['notif' => $results]);
    }


}
