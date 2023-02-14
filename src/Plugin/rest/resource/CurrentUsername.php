<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\user\Entity\User;

/**
 * @RestResource(
 *   id = "current_user_name",
 *   label = @Translation("Current Username"),
 *   uri_paths = {
 *     "canonical" = "/get-current-user-name",
 *   }
 * )
 */

class CurrentUsername extends ResourceBase{

    // Implements GET request to get the current username

	public function get(){

        $uid = \Drupal::currentUser()->id();

        $user = User::load($uid);

        return new JsonResponse(['username' => $user->label()]);

	}

}