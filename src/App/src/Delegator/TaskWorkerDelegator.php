<?php
declare(strict_types=1);

namespace App\Delegator;

use App\Worker\TaskWorker;
use Psr\Container\ContainerInterface;
use Swoole\Http\Server as HttpServer;

class TaskWorkerDelegator
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback) : HttpServer
    {
        $server = $callback();

        $server->on('task', $container->get(TaskWorker::class));
        $server->on('finish', function ($server, $taskId, $data) {
            
        });

        return $server;
    }
}