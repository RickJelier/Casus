<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class indexController extends Controller
{
	/**
	 * @Route("/", name="home")
	 */
	public function indexAction()
	{
		return $this->render('index.html.twig');
	}

	/**
	 * @Route("/load", name="load")
	 */
	public function loadAction(KernelInterface $kernel)
	{
		$application = new Application($kernel);
		$application->setAutoExit(false);

		$input = new ArrayInput(array(
			'command' => 'doctrine:fixtures:load',
			'--append' => '--append'
		));
		$output = new BufferedOutput();
		$application->run($input, $output);

		$content = $output->fetch();

		return new Response($content);
	}
}