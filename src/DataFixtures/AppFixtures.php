<?php

namespace App\DataFixtures;

use App\Story\DefaultFeesStory;
use App\Story\DefaultUserStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultFeesStory::load();
        DefaultUserStory::load();
    }
}
