<?php


namespace N3rtrivium\KakonuntiumBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

/**
 * Adds headers to allow Cross site request
 *
 * CorsResponseListener
 */
class CorsResponseListener
{
	public function onKernelResponse(FilterResponseEvent $event)
	{
		// set the "Access-Control-Allow-Origin" to allow XMLHttpRequests from everywhere
		$event->getResponse()->headers->set('Access-Control-Allow-Origin', '*');
	}
} 