<?php

namespace App\State;

use App\Entity\Fee;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;


#[AsDecorator('api_platform.doctrine.orm.state.persist_processor')]
class AssignOneUserForFeeStateProcessor implements ProcessorInterface
{
    public function __construct(private ProcessorInterface $innerProcessor, private EntityManagerInterface $entityManager)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if ($data instanceof Fee) {
            $owner = $this->entityManager->getRepository(User::class)->find(1);
            $data->setUser($owner);
        }

        $this->innerProcessor->process($data, $operation, $uriVariables, $context);
    }
    
}
