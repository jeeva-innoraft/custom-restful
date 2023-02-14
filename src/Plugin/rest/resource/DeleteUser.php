<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\user\Entity\User;

/**
 * @RestResource(
 *   id = "delete_user",
 *   label = @Translation("Delete User"),
 *   uri_paths = {
 *     "canonical" = "/delete-user",
 *   }
 * )
 */

class DeleteUser extends ResourceBase{

    // Implements delete request to delete the user

	public function delete(){

        $request = \Drupal::request()->query->all();

        if (isset($request['uid'])){

            $uid = $request['uid'];

            $user = User::load($uid);

            if (!empty($user))
            {

                $user->delete();

                return new JsonResponse(['msg' =>'User deleted']);

            }
            else
            {
                return new Response('Invalid Request',400);
            }
            

        }

        else
        {
            return new Response('Invalid Request',400);
        }

	}

}