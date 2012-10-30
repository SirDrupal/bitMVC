<?php
require_once './core/controller.php';
/**
 * Description of Default_controller
 *
 * @author lautarorosales
 */
class Default_controller implements controller {


    public function index($name = NULL){
        $view = new Default_view('index');
        $view->base_url = Url_helper::base_url();
        $view->load();
    }

}

?>
