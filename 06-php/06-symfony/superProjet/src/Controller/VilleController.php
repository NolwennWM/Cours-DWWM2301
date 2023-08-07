<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use App\Service\Mailer;
use App\Service\Uploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ville')]
class VilleController extends AbstractController
{
    public function __construct(private Uploader $uploader){}

    #[Route('/add', name: 'add_ville')]
    public function create(ManagerRegistry $doc, Request $request, Mailer $mailer): Response
    {
        /* 
            $em = $doc->getManager();
            $ville = new Ville();
            $ville  ->setNom("Lille")
                    ->setPopulation(234475)
                    ->setCreatedAt(new \DateTimeImmutable());
            $em->persist($ville);

            $ville2 = new Ville();
            $ville2 ->setNom("Nice")
                    ->setPopulation(342669)
                    ->setCreatedAt(new \DateTimeImmutable());
            $em->persist($ville2);
            
            $em->flush();

            return $this->redirectToRoute("readVille"); 
        */
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        // $form->remove("createdAt");

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $photo = $form->get("photoFile")->getData();
            if($photo)
            {
                $dir = $this->getParameter("ville_directory");
                $ville->setPhoto($this->uploader->uploadFile($photo, $dir));
            }
            dump($ville);
            $em = $doc->getManager();
            $em->persist($ville);
            $em->flush();

            $mailer->sendMail();
            $this->addFlash("success", "Une nouvelle ville a bien été ajouté");
            return $this->redirectToRoute("readVille");
        }

        return $this->render("ville/create.html.twig", [
            "villeForm"=> $form->createView()
        ]);
    }
    #[Route("/delete/{id<\d+>}", name: "deleteVille")]
    public function delete(Ville $ville=null, ManagerRegistry $doc): Response
    {
        if($ville)
        {
            $em = $doc->getManager();
            $em->remove($ville);
            $em->flush();
            $this->addFlash("danger", "la ville a bien été supprimée");
        }
        return $this->redirectToRoute("readVille");
    }
    // #[Route("/update/{id<\d+>}/{nom}/{pop<\d+>}", name: "updateVille")]
    #[Route("/update/{id<\d+>}", name: "updateVille")]
    public function update(Ville $ville=null, ManagerRegistry $doc, Request $request):Response
    {
        /* 
            if($ville)
            {
                $ville  ->setNom($nom)
                        ->setPopulation($pop);
                $em = $doc->getManager();
                $em->persist($ville);
                $em->flush();
                $this->addFlash("warning", "La ville a été mis à jour");
            } 
        */
        if(!$ville)
        {
            $this->addFlash("danger", "Aucune ville sélectionnée.");
            return $this->redirectToRoute("readVille");
        }
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $photo = $form->get("photoFile")->getData();
            if($photo)
            {
                $dir = $this->getParameter("ville_directory");
                $ville->setPhoto($this->uploader->uploadFile($photo, $dir));
            }
            $em = $doc->getManager();
            $em->persist($ville);
            $em->flush();

            $this->addFlash("success", "La ville a bien été édité");
            return $this->redirectToRoute("detailVille", ["id"=>$ville->getId()]);
        }
        return $this->render("ville/create.html.twig", [
            "villeForm"=>$form->createView()
        ]);
    }
    #[Route("/detail/{id<\d+>}", name: "detailVille")]
    // public function detail(ManagerRegistry $doc, $id):Response
    public function detail(Ville $ville=null):Response
    {
        // $repo = $doc->getRepository(Ville::class);
        // $ville = $repo->find($id);

        if(!$ville) return $this->redirectToRoute("readVille");

        return $this->render("ville/detail.html.twig", [
            "ville" => $ville
        ]);
    }
    #[Route("/{page?1}/{nb?5}", name: "readVille")]
    public function readAll(/*ManagerRegistry $doc, */VilleRepository $repo, $page, $nb): Response
    {
        // $repo = $doc->getRepository(Ville::class);
        dump($repo->findByPopulationInterval(50000, 300000));

        // $villes = $repo->findAll();
        $villes = $repo->findBy([], [], $nb, ($page-1)*$nb);
        $total = $repo->count([]);
        $nbPage = ceil($total/$nb);

        return $this->render('ville/index.html.twig', [
            'villes' => $villes,
            "nbPage" => $nbPage,
            "nombre" => $nb,
            "page" =>$page
        ]);
    }
    #[Route("/{name}/{nb?1}", name:"readVilleName")]
    public function readByName(VilleRepository $repo, $nb, $name): Response
    {
        if($nb>1)
        {
            $villes = $repo->findBy(["nom"=>$name],[], $nb);
            return $this->render("ville/index.html.twig", [
                "villes"=>$villes
            ]);
        }
        $ville = $repo->findOneBy(["nom"=>$name]);
        return $this->render("ville/detail.html.twig", [
            "ville"=> $ville
        ]);
    }
}
