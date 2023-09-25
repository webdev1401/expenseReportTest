<?php

namespace App\Story;

use App\Factory\FeeFactory;
use Zenstruck\Foundry\Story;

final class DefaultFeesStory extends Story
{
    public function build(): void
    {
        FeeFactory::createMany(5);
    }
}
