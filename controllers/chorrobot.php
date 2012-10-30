<?php
require_once './core/controller.php';
/**
 * Description of index
 *
 * @author lautarorosales
 */
class Chorrobot_controller implements controller {
    
    public $project_folder = '';


    public function index($name = NULL){
        $this->project_folder = $_SERVER['DOCUMENT_ROOT'] . '/projects/';
        $view = new Default_view('dashboard');
        $view->base_url = Url_helper::base_url();
        $view->projects = $this->_load_projects();
        $view->load();
    }
    
    
    public function run() {
        $view = new Default_view('dashboard');
        $view->base_url = Url_helper::base_url();
        $view->load();
    }
    
        
    private function _load_projects($projects = array()) {
        $projects = array();
        $projectsDirs = (file_helper::read_dir($this->project_folder));
        foreach($projectsDirs as $projectsDir) {
            $yml = $this->project_folder . $projectsDir . '/' . $projectsDir.'.yml';

            if (file_exists($yml)) {
                $yaml = new sfYamlParser();
                $projectData = $yaml->parse(file_get_contents($yml));
                if ($projectData) {
                    $projectName = (isset($projectData['project']['name'])) ? $projectData['project']['name'] : $projectsDir;
                    $projectDescription = (isset($projectData['project']['description'])) ? $projectData['project']['description'] : '';
                    $projectsArray['name'] = $projectName;
                    $projectsArray['description'] = $projectDescription;
                    $projectsArray['path'] = Url_helper::base_url() . '/default/run/' . $projectsDir;
                    $projectsArray['author'] = (isset($projectData['project']['author'])) ? $projectData['project']['author'] : '';
                    $projectsArray['creationDate'] = (isset($projectData['project']['creationDate'])) ? $projectData['project']['creationDate'] : '';    
                }
                $projects[] = $projectsArray;
            }
        }
        return $projects;
    }
}

?>
