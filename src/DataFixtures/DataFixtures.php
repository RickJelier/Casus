<?php

namespace App\DataFixtures;

use App\Entity\ClassGroup;
use App\Entity\Destination;
use App\Entity\Note;
use App\Entity\Project;
use App\Entity\Role;
use App\Entity\Tag;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class DataFixtures extends Fixture
{

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
	{
		$faker = Faker\Factory::create();

		for ($i = 0; $i <= 100; $i++) {
			$classGroup = new ClassGroup();
			$destination = new Destination();
			$note = new Note();
			$project = new Project();
			$role = new Role();
			$tag = new Tag();
			$user = new User();

			$classGroup->setName($faker->company);

			$note->setMessage($faker->word);

			$project->setName($faker->domainName);

			$role->setName($faker->word);

			$tag->setName($faker->safeHexColor);
			$tag->addProject($project);

			$destination->setName($faker->name);
			$destination->setLink($faker->url);
			$destination->setUsername($faker->userName);
			$destination->setPassword($faker->password());
			$destination->setToken($faker->md5);
			$destination->addNote($note);

			$user->setName($faker->name());
			$user->setEmail($faker->email);
			$user->setPassword($faker->password());
			$user->addDestination($destination);
			$user->addNote($note);
			$user->addCreatedProject($project);
			$user->addRole($role);
			$user->addGroup($classGroup);
			$user->addProject($project);

			$manager->persist($classGroup);
			$manager->persist($destination);
			$manager->persist($note);
			$manager->persist($project);
			$manager->persist($role);
			$manager->persist($tag);
			$manager->persist($user);
		}

		$manager->flush();
	}
}