<?php
/**
 * Created by PhpStorm.
 * User: marti
 * Date: 22/03/2018
 * Time: 15:54
 */

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class TrickFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i < 11; $i++)
        {
            $name = 'Figure'.$i;
            $description = 'Description de la figure : '.$i;
            $grp = mt_rand(1, 4);
            $trick = new Trick($name, $description, $grp);

            $manager->persist($trick);
        }

        $manager->flush();
    }
}