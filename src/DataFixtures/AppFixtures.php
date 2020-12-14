<?php

namespace App\DataFixtures;

use App\Entity\Material;
use App\Entity\Purchase;
use App\Entity\Stone;
use App\Entity\Supplier;
use App\Entity\Tag;
use App\Faker\Provider\ChakraProvider;
use App\Faker\Provider\CrystalSystemProvider;
use App\Faker\Provider\StoneProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $faker->addProvider(new StoneProvider($faker));
        $faker->addProvider(new ChakraProvider($faker));
        $faker->addProvider(new CrystalSystemProvider($faker));

        $suppliers = [];
        for ($i = 0; $i < 5; $i++) {
            $object = new Supplier();
            $object->setUrl($faker->url);
            $object->setName($faker->company);
            $manager->persist($object);
            $suppliers[] = $object;
        }

        array_map(function(string $label) use ($manager) {
            $object = new Tag();
            $object->setLabel($label);
            $manager->persist($object);
        }, [
            'WIP',
            'Mauvais état',
            'Qualité décevante',
        ]);

        foreach (StoneProvider::STONES as $stoneName) {
            $stone = new Stone();
            $stone->setLabel($stoneName);
            $stone->setImage('https://via.placeholder.com/80x80.png?text=?');
            $stone->setChakra($faker->chakraName());
            $stone->setCrystalSystem($faker->crystalSystemName());
            $stone->setNature($faker->word());
            $manager->persist($stone);

            $object = new Material();
            $object->setLabel("Perle de $stoneName");
            $object->setColor($faker->hexColor);
            $object->setImage('https://via.placeholder.com/80x80.png?text=?');
            $object->setUnits(0);
            $object->setThreshold(15);
            $object->setSize($faker->numberBetween(2, 12));
            $object->setDescription($faker->text(200));
            $object->setStone($stone);
            $manager->persist($object);

            $purchase = new Purchase();
            $purchase->setMaterial($object);
            $purchase->setSupplier($suppliers[$faker->numberBetween(0, count($suppliers)-1)]);
            $purchase->setUnits($faker->numberBetween(1, 7) * 10);
            $purchase->setPrice($faker->numberBetween(5, 20));
            $purchase->setPurchasedAt($faker->dateTimeBetween('-30 days', 'now'));
            $manager->persist($purchase);
        }
        try {
            $manager->flush();
        } catch (\Throwable $e) {
        }
    }
}
