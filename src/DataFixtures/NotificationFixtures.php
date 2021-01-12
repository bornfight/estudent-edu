<?php

namespace App\DataFixtures;

use App\Entity\Notification;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class NotificationFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $notification1 = new Notification();
        $notification1
            ->setTitle($this->faker->sentence(5))
            ->setContent($this->faker->text(400))
            ->setCreatedAt(new DateTime());
        $manager->persist($notification1);

        $notification2 = new Notification();
        $notification2
            ->setTitle($this->faker->sentence(5))
            ->setContent($this->faker->text(400))
            ->setCreatedAt(new DateTime());
        $manager->persist($notification2);

        $manager->flush();
    }
}
