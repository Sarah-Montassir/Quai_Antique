<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MethodPathExtension extends AbstractExtension
{

    private RouterInterface $router;
    private RequestStack $requestStack;


    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('method_path', [$this, 'generateMethodPath'])
        ];
    }

    public function generateMethodPath(string $routeName, array $routeParams = [], string $method = 'GET'): string
    {
        $request = $this->requestStack->getMainRequest();
        $request->setMethod($method);

        // Restore the original request method

        return  $this->router->generate($routeName, $routeParams);
    }

}