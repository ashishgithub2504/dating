<?php namespace BannerManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

/**
 * BannerImages Model
 *
 * @property \BannerManager\Model\Table\BannersTable|\Cake\ORM\Association\BelongsTo $Banners
 *
 * @method \BannerManager\Model\Entity\BannerImage get($primaryKey, $options = [])
 * @method \BannerManager\Model\Entity\BannerImage newEntity($data = null, array $options = [])
 * @method \BannerManager\Model\Entity\BannerImage[] newEntities(array $data, array $options = [])
 * @method \BannerManager\Model\Entity\BannerImage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BannerManager\Model\Entity\BannerImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BannerManager\Model\Entity\BannerImage[] patchEntities($entities, array $data, array $options = [])
 * @method \BannerManager\Model\Entity\BannerImage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BannerImagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('banner_images');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Banners', [
            'foreignKey' => 'banner_id',
            'joinType' => 'INNER',
            'className' => 'BannerManager.Banners'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title', 'Please enter title here.');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        // $validator
        //     ->scalar('external_link')
        //     ->maxLength('external_link', 255)
        //     ->add('external_link', 'valid-url', ['rule' => 'url'])
        //     ->allowEmpty('external_link');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->requirePresence('image', 'create', 'Please choose image here.')
            ->notEmpty('image', 'Please choose image here.');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order', 'Please enter order here.');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['banner_id'], 'Banners'));
        return $rules;
    }

    public function afterDelete(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!empty($entity->image)) {
            $file = new File("img/".$entity->image, false, 0755);
            if ($file->exists()) {
                $file->delete();
            }
        } 
    }
}
