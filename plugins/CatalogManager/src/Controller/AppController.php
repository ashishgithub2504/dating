<?php namespace CatalogManager\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        Configure::write('OptionsType', ['Choose' => [
                'select' => 'Select', 'radio' => 'Radio', 'checkbox' => 'Checkbox'],
            'Input' => ['text' => 'Text', 'textarea' => 'Textarea']]
        );
    }
}
