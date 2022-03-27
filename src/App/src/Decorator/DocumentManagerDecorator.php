<?php
declare(strict_types=1);

namespace App\Decorator;

use Closure;
use Helderjs\Component\DoctrineMongoODM\Decorator\DocumentManagerDecorator as DoctrineMongoODMDocumentManagerDecorator;

class DocumentManagerDecorator extends DoctrineMongoODMDocumentManagerDecorator
{
    private Closure $createDM;
    /**
     * Class constructor.
     */
    public function __construct(callable $createDM)
    {
        parent::__construct($createDM());
        $this->createDM = Closure::fromCallable($createDM);
    }
    /**
     * @return void
     */
    public function open(): void
    {
        if (!$this->isOpen()) {
            $this->wrapped = ($this->createDM)();
        }
    }
}