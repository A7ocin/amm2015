<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';
include_once basename(__DIR__) . '/../model/ModelFactory.php';
include_once basename(__DIR__) . '/../model/Model.php';
include_once basename(__DIR__) . '/../model/User.php';

/**
 * This is the controller used by the user with artist privileges  
 *
 * @author Nicola Garau
 */
class ArtistController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This method handles the user's input 
     * @param type $request the request
     */
    public function handleInput(&$request) {

        // create the view descriptor
        $vd = new ViewDescriptor();

        // set page
        $vd->setPagina($request['page']);

        if (!$this->loggedIn()) {
            // User not logged in, show the homepage
            $this->showLoginPage($vd);
        } else {
            // User logged in
            $user = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);

            // Switch between the different subpages. Different pages have different views
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    // Personal infos
                    case 'anagrafica':
                        $vd->setSottoPagina('anagrafica');
                        break;

                    // 3D models database
                    case 'modelli':
                        $models = ModelFactory::instance()->getModelsPerArtist($user);
                        $vd->setSottoPagina('modelli');
                        break;

                    // Edit model
                    case 'modelli_modifica':
                        $msg = array();
                        $models = ModelFactory::instance()->getModelsPerAdministrator($user);
                        $mod_model = $this->getModello($request, $msg);
                        if (!isset($mod_model)) {
                            $vd->setSottoPagina('modelli');
                        } else {
                            $vd->setSottoPagina('modelli_modifica');
                        }
                        break;

                    // Create model
                    case 'modelli_crea':
                        $msg = array();
                        $models = ModelFactory::instance()->getModelsPerArtist($user);
                        if (!isset($request['cmd'])) {
                            $vd->setSottoPagina('modelli');
                        } else {
                            $vd->setSottoPagina('modelli_crea');
                        }

                        break;

                    // Users list
                    case 'utenti':
						$utenti = UserFactory::instance()->getListaUsers();
                        $vd->setSottoPagina('utenti');
                        break;

                    // Search 3D models
                    case 'el_modelli':
                        $models = ModelFactory::instance()->getModelsPerArtist($user);
                        $vd->setSottoPagina('el_modelli');
                        $vd->addScript("../js/jquery-2.1.1.min.js");
                        $vd->addScript("../js/elencoModelliArtist.js");
                        break;

                    // Manage the Ajax request for models filtering
                    case 'filtra_modelli':
                        $vd->toggleJson();
                        $vd->setSottoPagina('el_modelli_json');
                        $errori = array();

                        if (isset($request['uploader'])) {
                            $uploader = $request['uploader'];
                        }else{
                            $uploader = null;
                        }

                        if (isset($request['nome'])) {
                            $nome = $request['nome'];
                        }else{
                            $nome = null;
                        }
    
                        $models_f = ModelFactory::instance()->ricercaModelli($uploader, $nome);

                        break;

                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }


            // Switch between the user's commands
            if (isset($request["cmd"])) {

                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;

                    // Personal infos
                    case 'personalInfo':
                        $msg = array();
                        $this->aggiornaIndirizzo($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Personal infos updated");
                        $this->showHomeUtente($vd);
                        break;

                    // Contacts
                    case 'contatti':
                        $msg = array();
                        $this->aggiornaEmail($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password updated");
                        $this->showHomeUtente($vd);
                        break;

                    // Password
                    case 'password':
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password updated");
                        $this->showHomeUtente($vd);
                        break;

                    // Model edit request
                    case 'a_modifica':
                        $models = ModelFactory::instance()->getModelsPerAdministrator($user);
                        if (isset($request['modello'])) {
                            $intVal = filter_var($request['modello'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($intVal)) {
                                $mod_model = $this->cercaModelloPerId($intVal, $models);
                            }
                        }
                        $this->showHomeUtente($vd);
                        break;

                    // Model save request
                    case 'a_salva':
                        $msg = array();
                        if (isset($request['modello'])) {
                            $intVal = filter_var($request['modello'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($intVal)) {
                                $mod_model = $this->cercaModelloPerId($intVal, $models);
                                $this->updateModello($mod_model, $request, $msg);
                                if (count($msg) == 0 && ModelFactory::instance()->salva($mod_model) != 1) {
                                    $msg[] = '<li>Sorry! I wasn\'t able to save the model</li>';
                                }
                                $this->creaFeedbackUtente($msg, $vd, "Modello aggiornato");
                                if (count($msg) == 0) {
                                    $vd->setSottoPagina('modelli');
                                }
                            }
                        } else {
                            $msg[] = '<li>Model not requested</li>';
                        }
                        $this->showHomeUtente($vd);
                        break;

                    // Back
                    case 'a_annulla':
                        $vd->setSottoPagina('modelli');
                        $this->showHomeUtente($vd);
                        break;

                    // Model creation request
                    case 'a_crea':
                        $models = ModelFactory::instance()->getModelsPerArtist($user);
                        $vd->setSottoPagina('modelli_crea');
                        $this->showHomeUtente($vd);
                        break;

                    // Create a model
                    case 'a_nuovo':
                        $msg = array();
                        $nuovo = new Model();
                        $nuovo->setId(-1);
                        $nuovo->setUploader($user->getUsername());
                        $this->updateModello($nuovo, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Model created");
                        if (count($msg) == 0) {
                            $vd->setSottoPagina('modelli');
                            if (ModelFactory::instance()->nuovo($nuovo) != 1) {
                                $msg[] = '<li>Sorry! I wasn\'t able to create the model</li>';
                            }
                        }
                        $models = ModelFactory::instance()->getModelsPerArtist($user);
                        $this->showHomeUtente($vd);
                        break;

                    // Delete a model
                    case 'a_cancella':
                        if (isset($request['modello'])) {
                            $intVal = filter_var($request['modello'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($intVal)) {
                                $mod_model = ModelFactory::instance()->cercaModelPerId($intVal);
                                if ($mod_model != null) {
                                    if (ModelFactory::instance()->cancella($mod_model) != 1) {
                                        $msg[] = '<li>Sorry! I wasn\'t able to delete the model</li>';
                                    }
                                }

                                $this->creaFeedbackUtente($msg, $vd, "Model deleted");
                            }
                        }
                        $models = ModelFactory::instance()->getModelsPerAdministrator($user);
                        $this->showHomeUtente($vd);
                        break;

                    // Model search
                    case 'e_cerca':
                        $msg = array();
                        $this->creaFeedbackUtente($msg, $vd, "Lo implementiamo con il db, fai conto che abbia funzionato ;)");
                        $this->showHomeUtente($vd);
                        break;

                    // default
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                // nessun comando, dobbiamo semplicemente visualizzare 
                // la vista
                // nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }


        // Call the view
        require basename(__DIR__) . '/../view/master.php';
    }

    /**
     * Updates a model
     * @param Modello $mod_model the model to be edited
     * @param array $request the request
     * @param array $msg an error array
     */
    private function updateModello($mod_model, &$request, &$msg) {
        if (isset($request['data'])) {
            $data = DateTime::createFromFormat("d/m/Y", $request['data']);
            if (isset($data) && $data != false) {
                $mod_model->setData($data);
            } else {
                $msg[] = "<li>The date is incorrect. Please insert a date in the format day/month/year</li>";
            }
        }
        if (isset($request['posti'])) {
            if (!$mod_model->setDimensione($request['posti'])) {
                $msg[] = "<li>The dimension is incorrect</li>";
            }
        }
        if (isset($request['name'])) {
            if (!$mod_model->setNome($request['name'])) {
                $msg[] = "<li>The name is incorrect</li>";
            }
        }
        if (isset($request['description'])) {
            if (!$mod_model->setDescrizione($request['description'])) {
                $msg[] = "<li>The description is incorrect</li>";
            }
        }
    }

    /**
     * Search a model by id
     * @param int $id the requested id
     * @param array $models a Model array
     * @return Modello the model with the requested id, null otherwise
     */
    private function cercaModelloPerId($id, &$models) {
        foreach ($models as $model) {
            if ($model->getId() == $id) {
                return $model;
            }
        }

        return null;
    }

    /**
     * Returns the requested model
     * @param array $request HTTP request
     * @param array $msg an error array
     * @return Modello selected model, null otherwise
     */
    private function getModello(&$request, &$msg) {
        if (isset($request['modello'])) {
            $model_id = filter_var($request['modello'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            $model = ModelFactory::instance()->cercaModelPerId($model_id);
            if ($model == null) {
                $msg[] = "The selected model is incorrect</li>";
            }
            return $model;
        } else {
            return null;
        }
    }

}

?>
