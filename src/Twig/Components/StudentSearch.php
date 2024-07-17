<?php

namespace App\Twig\Components;

use App\Entity\Classes;
use App\Repository\ClassesRepository;
use App\Repository\StudentsRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
final class StudentSearch
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private StudentsRepository $studentsRepository) {}

    public function getStudents()
    {
        if (!empty($this->query)) {

            return $this->studentsRepository->findLike($this->query);
        }
    }
}