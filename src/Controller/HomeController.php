<?php

namespace App\Controller;


use App\Entity\Classes;
use App\Repository\ClassesRepository;
use App\Repository\ScanRepository;
use App\Repository\StudentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{

    public array $exitList;
    public array $enterList;

    public function __construct()
    {
        $this->enterList = [];
        $this->exitList = [];
    }

    #[Route('', name: 'index')]
    public function index(ScanRepository $scanRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $exitList = $scanRepository->findBy(['isIn' => false], ['id' => 'DESC'], 5);
        $entryList = $scanRepository->findBy(['isIn' => true], ['id' => 'DESC'], 5);

        //dd($entryList);

        return $this->render('home/index.html.twig', [
            'entryList' => $entryList,
            'exitList' => $exitList,
        ]);
    }

    #[Route('entries', name: 'student_entries')]
    public function entries(ScanRepository $scanRepository): Response
    {
        $entryList = $scanRepository->findBy(['isIn' => true], ['id' => 'DESC'], 5);

        return $this->render('home/entries.html.twig', ['entryList' => $entryList]);
    }

    #[Route('exits', name: 'student_exits')]
    public function exits(ScanRepository $scanRepository): Response
    {
        $exitList = $scanRepository->findBy(['isIn' => false], ['id' => 'DESC'], 5);

        return $this->render('home/exits.html.twig', ['exitList' => $exitList]);
    }

    #[Route('classes', name: 'classes')]
    public function classes(ClassesRepository $classesRepository): Response
    {
        $classes = $classesRepository->findAll();

        return $this->render('home/classes.html.twig', ['classes' => $classes,]);
    }

    #[Route('internat', name: 'internat')]
    public function internat(StudentsRepository $studentsRepository): Response
    {
        $boarders = $studentsRepository->findBoarders('interne');

        return $this->render('home/internat.html.twig', ['students' => $boarders]);
    }

    #[Route('research', name: 'research')]
    public function research(): Response
    {


        return $this->render('home/research.html.twig',);
    }
}
