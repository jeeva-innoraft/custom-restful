<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\user\Entity\User;

/**
 * @RestResource(
 *   id = "get_user_details",
 *   label = @Translation("User Details"),
 *   uri_paths = {
 *     "canonical" = "/user-details",
 *   }
 * )
 */

class GetUserDetails extends ResourceBase{

    // Implements GET request to get user details

	public function get(){

        $request = \Drupal::request()->query->all();

        $user_details = [];

        if (isset($request['uid'])) {

            $uid = $request['uid'];

            $user = User::load($uid);

            if (!empty($user)) {

                $name = $user->label();

                $email = $user->get('mail')->value;

                $uid = $user->id();

                $date = \Drupal::service('date.formatter')->format($user->getCreatedTime(),'html_date');

                $user_details = ['uid' => $uid, 'name' => $name, 'email' => $email, 'date' => $date];

            }

            else
            {

                $user_details = [];

            }
    
        }
        else 
        {
            $users = User::loadMultiple();

            foreach ($users as $user)
            {
                $name = $user->label();

                $email = $user->get('mail')->value;

                $uid = $user->id();

                $date = \Drupal::service('date.formatter')->format($user->getCreatedTime(),'html_date');

                $user_details[] = ['uid' => $uid, 'name' => $name, 'email' => $email, 'date' => $date];
                
            }

        }


        return new JsonResponse($user_details);
		
	}
}