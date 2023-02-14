<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\Response;


/**
 * @RestResource(
 *   id = "server_error",
 *   label = @Translation("Server Error"),
 *   uri_paths = {
 *     "canonical" = "/server-error",
 *   }
 * )
 */

class ServerError extends ResourceBase{

    // Implements GET request to return 500 Internal server

	public function get(){


        return new Response('Internal Server Error 500', 500);
		
	}
}