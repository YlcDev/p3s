<?php

namespace YLC\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BlogBundle:Article')->findAll();
        return $this->render('BlogBundle:Default:index.html.twig',array(
            'articles' => $articles,
        ));
    }

    /**
     * @Route("/list", name="list")
     */
    public function listAction()
    {

        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('BlogBundle:Article')->findAll();
        return $this->render('BlogBundle:Default:list.html.twig',array(
            'articles' => $articles,
        ));
    }

    /**
     * @Route("/article-{tag}.html", name="show_article")
     */
    public function showArticleAction($tag)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Article');

        $article = $repository->findOneBy(array('tag' => $tag));

        return $this->render('BlogBundle:Default:showArticle.html.twig',
            array(
                'article' => $article
            )
        );
    }
}
