<?php

namespace HueSwitchBundle\Controller;

use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
        $client = new Client();
        $response = $client->request('GET', 'http://10.0.1.207/api/Z6co6AhlJRO2HOmRqQ9WYtWIoS0cw1qhgvuuefyM/scenes');
        $scenes = json_decode($response->getBody());
        
        $array = [];
        foreach ($scenes as $key => $value) {
            $array[$key] = $value;
        }
        return $this->render('HueSwitchBundle:Default:index.html.twig', array('scenes' => $array, 'foo' => 'foobar'));
    }
    
    /**
     * @Route("/off")
     */
    public function offAction() {
        $client = new Client();
        $response = $client->request('PUT', 'http://10.0.1.207/api/Z6co6AhlJRO2HOmRqQ9WYtWIoS0cw1qhgvuuefyM/lights/7/state', ['json' => ['on' => false]]);
        return $this->redirect($this->generateUrl('homepage'));
    }
    
    /**
     * @Route("/on")
     */
    public function onAction() {
        $client = new Client();      
        $response = $client->request('PUT', 'http://10.0.1.207/api/Z6co6AhlJRO2HOmRqQ9WYtWIoS0cw1qhgvuuefyM/lights/7/state', ['json' => ['on' => true]]);
        return $this->redirect($this->generateUrl('homepage'));
    }
    
    /**
     * @Route("/offscene")
     */
    public function offSceneAction(Request $request) {
        echo '<pre>';
        var_dump('off');
        exit;
        $sceneId = $request->request->get('sceneId');
        $client = new Client();      
        $response = $client->request('PUT', 'http://10.0.1.207/api/Z6co6AhlJRO2HOmRqQ9WYtWIoS0cw1qhgvuuefyM/scenes/'.$sceneId.'/lightstates', ['json' => ['on' => false]]);
        return $this->redirect($this->generateUrl('homepage'));
    }
    
    /**
     * @Route("/onscene")
     */
    public function onSceneAction(Request $request) {
        $sceneId = $request->request->get('sceneId');
        $client = new Client();      
        $response = $client->request('PUT', 'http://10.0.1.207/api/Z6co6AhlJRO2HOmRqQ9WYtWIoS0cw1qhgvuuefyM/scenes/'.$sceneId.'/lightstates', ['json' => ['on' => true]]);
        return $this->redirect($this->generateUrl('homepage'));
    }
    
}
