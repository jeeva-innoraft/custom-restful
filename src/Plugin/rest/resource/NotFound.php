<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\Response;


/**
 * @RestResource(
 *   id = "not_found",
 *   label = @Translation("Not Found"),
 *   uri_paths = {
 *     "canonical" = "/not-found",
 *   }
 * )
 */

class NotFound extends ResourceBase{

    // Implements GET request to return 404 not found

	public function get(){

        return new Response('404 Not Found', 404);
		
	}
}