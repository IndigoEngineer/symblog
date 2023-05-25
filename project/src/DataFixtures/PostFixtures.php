<?php

namespace App\DataFixtures;

use App\Entity\Post\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Core\File;
use Faker\Factory;
use Faker\Generator;

class PostFixtures extends Fixture

{
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        $posts=[];
        for ($i=0; $i < 50 ; $i++) {
            $post = new Post();
            $post->setTitle($this->faker->words(4, true))
                ->setContent($this->faker->paragraph(3))
                ->setState(mt_rand(0,2) == 1 ?  Post::STATES[0]: Post::STATES[1] );
            $manager->persist($post);
        }
        $manager->flush();

    }
}
