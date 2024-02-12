<?php

declare(strict_types=1);

namespace B13\SlashForce\Middleware;

/*
 * This file is part of TYPO3 CMS-based extension "slash_forcer" by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Routing\PageArguments;
use TYPO3\CMS\Core\Site\Entity\Site;

class SlashForcer implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getMethod() !== 'GET' && $request->getMethod() !== 'HEAD') {
            return $handler->handle($request);
        }

        $site = $request->getAttribute('site');

        if (!$site instanceof Site) {
            return $handler->handle($request);
        }

        $uri = $request->getUri();
        if (str_ends_with($uri->getPath(), '/')) {
            return $handler->handle($request);
        }

        if (!$this->siteHasSlashConfiguredForCurrentPageType($site, $request)) {
            return $handler->handle($request);
        }

        return new RedirectResponse($uri->withPath($uri->getPath() . '/'), 301);
    }

    private function siteHasSlashConfiguredForCurrentPageType(Site $site, ServerRequestInterface $request): bool
    {
        $pageArguments = $request->getAttribute('routing');
        if (!$pageArguments instanceof PageArguments) {
            return false;
        }

        $pageType = $pageArguments['pageType'] ?? null;
        if ($pageType === null) {
            return false;
        }
        $routeEnhancers = $site->getConfiguration()['routeEnhancers'] ?? null;
        if ($routeEnhancers === null) {
            return false;
        }

        $pageTypeSuffix = $routeEnhancers['PageTypeSuffix'] ?? null;
        if ($pageTypeSuffix === null) {
            return false;
        }

        $map = $pageTypeSuffix['map'] ?? null;
        if ($map === null) {
            return false;
        }

        return (array_flip($map)[(int)$pageType] ?? null) === '/' || (array_flip($map)[$pageType] ?? null) === '/';
    }
}
