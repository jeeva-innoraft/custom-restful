<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @RestResource(
 *   id = "get_query",
 *   label = @Translation("Get Query"),
 *   uri_paths = {
 *     "canonical" = "/get-path-query",
 *   }
 * )
 */

class GetQuery extends ResourceBase{


	// Implements GET request to get all requery in the request

	public function get(){

		$request = \Drupal::request()->query->all();

		return new JsonResponse($request);
	}
}