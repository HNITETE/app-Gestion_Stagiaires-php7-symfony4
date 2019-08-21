<?php

namespace App\Controller;


use App\Entity\Stagiaire;
use App\Form\AddStagiaireType;
use Doctrine\DBAL\Types\DateTimeType;
use Proxies\__CG__\App\Entity\Groupe;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Date;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog")
     */
    public function index()
    {
        $stgs=$this->getDoctrine()
            ->getRepository("App:Stagiaire")
            ->findAll();
        return $this->render('stagiaires/index.html.twig', array("stgs"=>$stgs));
    }
    /**
     * @Route("/details_stg/{id}", name="detail_stg")
     */
    public function details($id)
    {/*
        $qb = $this->getDoctrine()
            ->getRepository("App:Stagiaire")
            ->createQueryBuilder('stagiaire')
            ->select('stagiaire.codest, stagiaire.nomst, stagiaire.prenomst')
            //->innerJoin(Groupe::class, 'groupe', 'WITH', 'groupe.codegr = stagiaire.codegr')
            ->where('stagiaire.codest = :codest ')
            ->setParameter('codest', $id )
            // ->setParameter('langTwo', $langTwo)
            ->getQuery();

        $stg=$qb->getResult();
        return $this->render('stagiaires/details.html.twig', array("stg"=>$stg));
        $stgs=$this->getDoctrine()->getEntityManager();
        $con=$stgs->getConnection();
        $sql='select * from Stagiaire stg, Groupe grp where stg.codegr=grp.codegr';
        $stmt=$con->prepare($sql);
        $stmt->execute();*/
        $stg = $this->getDoctrine()
            ->getRepository(Stagiaire::class)
            ->find($id);
        //return new Response('Check out this great product: '.$stg->getNom());
        $grp = $stg->getCodegr();
        return $this->render('Stagiaires/details.html.twig', array("stg"=>$stg,"grp"=>$grp));
    }
    /**
     * @Route("/delete/{id}", name="delete_stg")
     */
    public function delete_stg($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $stg=$entityManager->getRepository('App:Stagiaire')->find($id);
        $entityManager->remove($stg);
        $entityManager->flush();

        //notice
        $this->addFlash('error','Satagiaire REMOVED');

        return $this->redirectToRoute('blog');
    }
    /**
     * @Route("/create_stagiaire", name="create_stg")

     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajouter(Stagiaire $stagiaire = null, Request $request, ObjectManager $manager)
    {
        dump($request);
        if ($request->request->count() > 0){
            $grp= new Groupe();
            $grp = $this->getDoctrine()
                ->getRepository(Groupe::class)->findOneBy(
                ['codegr' => $request->request->get('code')]
            );
            dump($grp);

            $stagiaite=new Stagiaire();

            $stagiaite->setNomst($request->request->get('nom'));
            $stagiaite->setPrenomst($request->request->get('prenom'));
            $stagiaite->setEmail($request->request->get('email'));
            $stagiaite->setPhone($request->request->get('phone'));
            $stagiaite->setCin($request->request->get('cin'));
            $stagiaite->setSexest($request->request->get('sexe'));
            $stagiaite->setCodegr($grp);
            $stagiaite->setDatensst($request->request->get('daten'));
            $stagiaite->setBrochure($request->request->get('pic'));

            /*$file = $stagiaite->getBrochure();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }*/

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            //$stagiaite->setBrochure($fileName);

            $manager->persist($stagiaite);
            $manager->flush();
            $this->addFlash('notice','Satagiaire ADDED');
            return $this->redirectToRoute('blog');

        }

        return $this->render("stagiaires/ajouter.html.twig");


    }
    /**
     * @Route("/create_stagiaire/{id}/edit", name="edit_stg")
     */
    public function editAction(Stagiaire $stagiaire,Request $request,ObjectManager $manager)
    {
        // On crée un objet Advert

        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->createFormBuilder($stagiaire);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('nomst',   TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            ->add('prenomst',    TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            ->add('datensst', TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            ->add('sexest',      TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            ->add('Email',      TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            ->add('phone',      NumberType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            ->add('cin',      TextType::class,array("attr"=>array("class"=>"form-control","style"=>"margin-bottom:16px")))
            //->add('brochure', FileType::class, ['label' => 'Brochure (PDF file)'])
            ->add('valider',SubmitType::class,array('label' => 'Update Stagiaire',"attr"=>array("class"=>"btn btn-primary btn-lg btn-block","style"=>"margin-bottom:16px")))
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $grp= new Groupe();
            $grp = $this->getDoctrine()
                ->getRepository(Groupe::class)->findOneBy(
                    ['codegr' => $request->request->get('code')]
                );
            dump($grp);

            $stagiaite = $this->getDoctrine()->getRepository(Stagiaire::class)->find($stagiaire);
             $stagiaite=$form->getData();
            /*$stagiaite->setNomst($request->request->get(getNomst()));
            $stagiaite->setPrenomst($request->request->get('prenom'));
            $stagiaite->setEmail($request->request->get('email'));
            $stagiaite->setPhone($request->request->get('phone'));
            $stagiaite->setCin($request->request->get('cin'));
            $stagiaite->setSexest($request->request->get('sexe'));
            $stagiaite->setCodegr($grp);
            $stagiaite->setDatensst($request->request->get('daten'));*/
            $manager->persist($stagiaite);
            $manager->flush();
            $this->addFlash('notice','Satagiaire UPDATED');
            return $this->redirectToRoute('blog');
        }

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('Stagiaires/update.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
