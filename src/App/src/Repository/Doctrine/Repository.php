<?php

declare(strict_types=1);
 
namespace App\Repository\Doctrine;

use Broadway\Domain\AggregateRoot;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class Repository extends DocumentRepository implements RepositoryInterface{
    
    public function save(AggregateRoot $document): void
    {
        $dm =  $this->getDocumentManager();
        $dm->persist($document);
        $dm->flush();
    }

    public function update(AggregateRoot $document) : void
    {
        $this->getDocumentManager()->merge($document);
        $this->getDocumentManager()->flush();
    }

    /**
     * @param mixed $document
     */
    public function remove(AggregateRoot $document): void
    {
        $dm = $this->getDocumentManager();
        $dm->remove($document);
        $dm->flush();
    }

    public function findOneAndRemove(array $criteria): void
    {
        $document = $this->findOneBy($criteria);
        $this->remove($document);
    }
}