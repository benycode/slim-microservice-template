
<?php

declare(strict_types=1);

namespace App\Action\v1_0\Overview;

use App\ActionAbstract;
use App\ActionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class \App\Action\v1_0\Overview\StartupAction
 *
 * @RoutePrefix("/v1.0")
 */
final class HomeAction
{
	/**
     * @Route("/hello", methods={"GET"}, name="example.hello")
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function hello(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {

		   //...
    }
}
