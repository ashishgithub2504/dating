<?php
namespace BannerManager\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;
/**
 * Banner cell
 */
class BannerCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function defaultBanner()
    {
        $this->Banners = TableRegistry::get('BannerManager.Banners');
        $query = $this->Banners->find('default');
        $banner = $query->cache('default_banner')->first();
        $this->set(compact('banner'));
    }
}
