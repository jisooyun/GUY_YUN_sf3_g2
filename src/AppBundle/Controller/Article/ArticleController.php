<?php

/**
 * Created by PhpStorm.
 * User: Jisoo
 * Date: 29/03/2016
 * Time: 18:10
 */

namespace AppBundle\Controller\Article;

use AppBundle\Entity\Article\Tag;
use AppBundle\Form\Type\Article\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/list", name="article_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();

        return $this->render("AppBundle:Article:index.html.twig", [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     */
    public function showAction($id, Request $request)
    {
        $tag = $request->query->get('tag');

        return new Response(
            'Affiche moi l\'article avec l\'id: '.$id.' avec le tag'.$tag
        );
    }

    /**
     * @Route("/show/{articleName}")
     *
     * @param $articleName
     *
     * @return Response
     */
    public function showArticleNameaction($articleName)
    {
        return $this->render('AppBundle:Article:index.html.twig', [
            'articleName' => $articleName,
        ]);
    }

    /**
     * @Route("/author", name="article_author")
     *
     *
     * @return Response
     */
    public function authorAction(Request $request)
    {
        $author = $request->query->get('author');

        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
            'author' => $author,
        ]);

        return $this->render('AppBundle:Article:index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/tag/new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);


        if ($form->isValid()) {
            //pour enregistrer les données rentrées dans le formulaire
            $em = $this->getDoctrine()->getManager();

            /** @var Tag $slug */
            $tag = $form->getData();

            // class StringUtil
            $stringUtil = $this->get('string.util');
            $slug = $stringUtil->slugify($tag->getName());
            $tag->setSlug($slug);

            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('article_list');
        }

        return $this->render('AppBundle:Article:tag.new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/new")
     * 
     * @param Request $request
     */
    public function newArticleAction()
    {
        
    }

}