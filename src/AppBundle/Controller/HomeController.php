<?php
/**
 * Created by PhpStorm.
 * User: Jisoo
 * Date: 30/03/2016
 * Time: 14:46
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();

        /*$article = new Article();

        $article
            ->setTitle('Titre de mon article aaaaahhhh')
            ->setContent('le contenu du premier article yeeeeesssss')
            ->setAuthor('Jisoo la plus belle')
            ->setTag('osef')
        ;

        $manager->persist($article);
        $manager->flush();
        */

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();


        return $this->render('AppBundle:Home:index.html.twig', [
            'articles' => $articles,
        ]);
    }

}