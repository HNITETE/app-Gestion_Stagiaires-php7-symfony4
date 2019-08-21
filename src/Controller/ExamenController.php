<?php

namespace App\Controller;
use App\Entity\Examen;
//use Proxies\__CG__\App\Entity\Seance;
use Proxies\__CG__\App\Entity\Seance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Annotation\Route;

class ExamenController extends AbstractController
{
    /**
     * @Route("/examens", name="examen_liste")
     */
    public function indexAction()
    {
        $exms=$this->getDoctrine()
            ->getRepository("App:Examen")
            ->findAll();
        return $this->render('examen/index.html.twig', array("exms"=>$exms));

    }

    /**
     * @Route("/create_examen", name="create_exm")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajouter(Request $request, ObjectManager $manager)
    {
        //dump($request);
        if ($request->request->count() > 0){
            $snc= new Seance();
            $snc = $this->getDoctrine()
                ->getRepository(Seance::class)->findOneBy(
                    ['codese' => $request->request->get('code')]
                );
            dump($snc);
            $examen=new Examen();
            $examen->setDateex($request->request->get('dateex'));
            $examen->setTypeex($request->request->get('typeex'));
            $examen->setCodeSe($snc);

            $manager->persist($examen);
            $manager->flush();
            $this->addFlash('notice','Examen ADDED');
            return $this->redirectToRoute('examen_liste');

        }

        return $this->render("examen/ajouter.html.twig");


    }
}
