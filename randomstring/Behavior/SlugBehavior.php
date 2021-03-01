<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Text;

/**
 * Slug behavior
 */
class SlugBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'slug' => 'slug',
        'replacement' => '-',
        'field' => '',
        'otherField'=>''
        
    ];
    
    /**
     * Method slug
     * @Description Method for create a unique slug
     * 
     * @param Entity $entity
     */
    public function slug(Event $event,Entity $entity)
    {
        $config     =   $this->getConfig();
        $value      =   ($entity->get($config['field']) != '' ) ? $entity->get($config['field']) : ( $config['otherField'] != NULL ?  $entity->get($config['otherField']) : '' );
        if(!empty($value)){
			$alias      =   strtolower(Text::slug(trim($value), $config['replacement']));
			$alias_ini  =   trim($alias);
			$i = 0;
			while ($this->isAliasExist($alias,$entity)) {
				$alias = $alias_ini . '-' . ++$i;
			}
			$entity->set($config['slug'], $alias);
		}	
    }
    
    /**
     * Method isAliasExist
     * 
     * @Description Method for check created slug is already exist or not
     * 
     * @param string $alias
     * @param object $entity
     * @return boolean
     */
    public function isAliasExist($alias, $entity) {        
        $conditions = [];
        $field = $this->getConfig('slug');
        $model = $this->_table->getAlias();
        $conditions[] = [$field => $alias];
        if ($entity->id) {
            $conditions[] = [$model.'.id !=' => $entity->id];
        }
        $total = $this->_table->find()->where($conditions)->count();        
        return ($total > 0) ? true : false;
    }
    
    
    /**
     * Method beforeSave
     * 
     * @Description method for set the slug value before inserted and updated record 
     * 
     * @param object $event
     * @param object $entity
     * @param Array $options
     * 
     * @return void
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
       $this->slug($event,$entity);
    }


}

