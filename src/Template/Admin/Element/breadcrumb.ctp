<?php

use Cake\Utility\Text;
use Cake\Utility\Inflector;
$act = strtolower(trim($this->request->getParam('action')));
$ctrl = Text::slug(Inflector::underscore($this->request->getParam('controller')));
$slugedAct = Text::slug(Inflector::underscore($this->request->getParam('action')));
$singular = str_replace("-", " ",ucfirst(Inflector::singularize($ctrl)));
$plural = str_replace("-", " ",ucfirst(Inflector::pluralize($ctrl)));
switch ($act) {
    case 'index' :
        $this->Breadcrumbs->add($plural, '', array('class' => 'breadcrumblast'));
        break;
    case 'add' :
        $id = $this->request->getParam('pass.0');
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl]);
        $this->Breadcrumbs->add($id?'Edit '.$singular:'Add '.$singular, '', array('class' => 'breadcrumblast'));
        break;
    case 'edit' :
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl]);
        $this->Breadcrumbs->add('Edit '.$singular, '', array('class' => 'breadcrumblast'));
        break;
    case 'view' :
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl]);
        $this->Breadcrumbs->add('View '.$singular, '', array('class' => 'breadcrumblast'));
        break;

    default :
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl]);
        $this->Breadcrumbs->add(ucfirst($act), '', array('class' => 'breadcrumblast'));
}
$this->Breadcrumbs->prepend(
    '<i class="fa fa-dashboard"></i> Home',
    ['controller' => 'Dashboard', 'action' => 'index','plugin' => NULL]
);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumb']
);
?>

