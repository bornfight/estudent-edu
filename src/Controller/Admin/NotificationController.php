<?php

namespace App\Controller\Admin;

use App\Entity\Notification;
use App\Form\NotificationType;
use App\Repository\NotificationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class NotificationController extends AbstractController
{
    private NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * @Route("/", name="admin_notification_list")
     */
    public function list(): Response
    {
        $notifications = $this->notificationRepository->findAll();

        return $this->render('admin/notification/list.html.twig', [
            'notifications' => $notifications
        ]);
    }

    /**
     * @Route("/notification/new", name="admin_notification_new")
     */
    public function new(Request $request): Response
    {
        $notification = new Notification();
        $notification->setCreatedAt(new DateTime());

        $form = $this->createForm(NotificationType::class, $notification);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notification);
            $entityManager->flush();

            $this->addFlash('success', 'Notification successfully created.');

            return $this->redirectToRoute('admin_notification_list');
        }

        return $this->render('admin/notification/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/notification/edit/{id}", name="admin_notification_edit")
     */
    public function edit(Notification $notification, Request $request): Response
    {
        $form = $this->createForm(NotificationType::class, $notification);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notification);
            $entityManager->flush();

            $this->addFlash('success', 'Notification successfully updated.');

            return $this->redirectToRoute('admin_notification_list');
        }

        return $this->render('admin/notification/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/notification/delete/{id}", name="admin_notification_delete")
     */
    public function delete(Notification $notification): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($notification);
        $entityManager->flush();

        $this->addFlash('success', 'Notification successfully deleted.');

        return $this->redirectToRoute('admin_notification_list');
    }
}
