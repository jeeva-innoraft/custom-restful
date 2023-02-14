<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;


/**
 * @RestResource(
 *   id = "redirect_to_home",
 *   label = @Translation("Redirect To Home"),
 *   uri_paths = {
 *     "canonical" = "/redirect-to-homepage",
 *   }
 * )
 */

class RedirectToHome extends ResourceBase{

    // Implements GET request to redirect home page

	public function get(){

        $home = Url::fromRoute('<front>')->toString();

        $response = new RedirectResponse($home);

        $response->send();

        return $response;
		
	}
}