<?php namespace CmsManager\Controller;

use CmsManager\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Pages Controller
 *
 * @property \CmsManager\Model\Table\PagesTable $Pages
 *
 * @method \CmsManager\Model\Entity\Page[] paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow();
        $_dir = str_replace("\\", "/", $this->Pages->_dir);
        $this->set(compact('_dir'));
    }

    /**
     * detail method
     *
     * @param string|null $slug Page slug.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function detail($slug = null)
    {
        $page = $this->Pages->find()->where(['slug' => $slug])->first();
        if (empty($page)) {
            throw new NotFoundException(__('Page not found'));
        }
        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }
}
