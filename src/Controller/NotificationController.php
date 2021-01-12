<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    private NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function notifications(): Response
    {
        $notifications = $this->notificationRepository->findAll();

        return $this->render('notification/homepage.html.twig', [
            'notifications' => $notifications
        ]);
    }

    /**
     * @Route("/notification/{id}", name="notification_single")
     */
    public function notification(Notification $notification): Response
    {
        return $this->render('notification/notification.html.twig', [
            'notification' => $notification
        ]);
    }
}
