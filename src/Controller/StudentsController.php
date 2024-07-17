<?php

namespace App\Controller;


use App\Entity\Classes;
use App\Entity\Scan;
use App\Entity\Students;
use App\Repository\ClassesRepository;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[Route('/student', name: 'students_')]
class StudentsController extends AbstractController
{

    #[Route(path:'/enter/{id}', name:'enter')]
    public function studentEnter(Students $student, EntityManagerInterface $entityManager, HomeController $homeController): Response
    {
        $student->setIn(true);
        $scan = new Scan();
        $scan->setStudent($student);
        $scan->setScannedAt(new \DateTimeImmutable());
        $scan->setIn($student->isIn());
        $entityManager->persist($scan);
        $entityManager->flush();

        return $this->redirectToRoute('home_index',);
    }

    #[Route(path:'/exit/{id}', name:'exit')]
    public function studentExit(Students $student, EntityManagerInterface $entityManager): Response
    {
        $student->setIn(false);
        $scan = new Scan();
        $scan->setStudent($student);
        $scan->setScannedAt(new \DateTimeImmutable());
        $scan->setIn($student->isIn());
        $entityManager->persist($scan);
        $entityManager->flush();

        return $this->redirectToRoute('home_index',);
    }

    #[Route(path:'/toggle/{id}', name:'toggle')]
    public function studentToggle(Students $students, EntityManagerInterface $entityManager)
    {
        if ($students->isIn()) {
            $students->setIn(false);
        } else {
            $students->setIn(true);
        }
    }
}