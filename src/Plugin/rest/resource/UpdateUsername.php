<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\user\Entity\User;

/**
 * @RestResource(
 *   id = "update_user_name",
 *   label = @Translation("Update Username"),
 *   uri_paths = {
 *     "canonical" = "/update-user-name",
 *   }
 * )
 */

class UpdateUsername extends ResourceBase{

    // Implements GET request to update the username

	public function get(){

        $request = \Drupal::request()->query->all();


        $user_details = [];

        if (isset($request['uid']) && isset($request['name'])) {

            $uid = $request['uid'];

            $user = User::load($uid);

            if (!empty($user)) {

                $name = $request['name'];

                $current_user_id = \Drupal::currentUser()->id();

                if ($uid == $current_user_id)
                {

                    $user->set('name',['value' =>$name]);

                    $user->save();

                    return new JsonResponse(['msg' => 'Username updated'], 200);

                }

                else
                {

                    return new JsonResponse(['msg' => 'UID not matched'], 404);


                }                

            }

            else
            {

                return new JsonResponse(['msg' => 'User not found'], 404);

            }
    
        }
        else 
        {
            return new JsonResponse(['msg' => 'UID not found'], 404);

        }
		
	}

}