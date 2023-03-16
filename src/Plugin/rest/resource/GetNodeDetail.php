<?php

namespace Drupal\custom_restful\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\Node;

/**
 * @RestResource(
 *   id = "get_node_data",
 *   label = @Translation("Node Data"),
 *   uri_paths = {
 *     "create" = "/get-node-data",
 *   }
 * )
 */

class GetNodeDetail extends ResourceBase{

    // Implements POST request to get the node data

	public function post(array $data){

        $token = 'ahuikdh46492273874-iuwdiugw6e66e';

        $headers = \Drupal::request()->headers->get('Authorization');

        if (!empty($headers))
        {

            if ($headers == $token)
            {

                if(isset($data['date']))
                {
                    $nodes = \Drupal::entityQuery('node')->accessCheck(FALSE)->condition('created' , $data['date'], '>')->execute();

                    $node_data  = Node::loadMultiple($nodes);

                    $res = [];

                    foreach ($node_data as $nd)
                    {
                        $res[] = ['title' => $nd->label(), 'body' => $nd->get('body')->value];
                    }

                }

                else
                {
                    $res  = [];
                }
            

            }

            else
            {
                $res = ['msg'=>'invalid token'];
            }

        }

        else
        {
            $res = ['msg' => 'token is required'];
        }

        return new JsonResponse($res);

	}

}