<?php

namespace App\Twig\Components;

use App\Entity\Classes;
use App\Repository\ClassesRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
final class ClassesSearch
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private ClassesRepository $classesRepository) {}

    public function getClass()
    {
        if (!empty($this->query)) {

            return $this->classesRepository->findOneBy(['name' => $this->query]);
        }
    }

    public function getAllClasses(): array
    {
        return $this->classesRepository->findAll();
    }
}