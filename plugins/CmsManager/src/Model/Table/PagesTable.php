<?php namespace CmsManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Filesystem\File;
use ArrayObject;

/**
 * Pages Model
 *
 * @method \CmsManager\Model\Entity\Page get($primaryKey, $options = [])
 * @method \CmsManager\Model\Entity\Page newEntity($data = null, array $options = [])
 * @method \CmsManager\Model\Entity\Page[] newEntities(array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Page|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CmsManager\Model\Entity\Page patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Page[] patchEntities($entities, array $data, array $options = [])
 * @method \CmsManager\Model\Entity\Page findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $_dir;

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->_dir = 'img' . DS . 'uploads' . DS . 'pages' . DS;
        $this->setTable('pages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Slug', [
            'field' => 'slug',
            'otherField' => 'title'
            ]
        );

        
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
            ->requirePresence('title', 'create')
            ->notEmpty('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table' ,'message'=>'Title must be unique.']);


        $validator
            ->scalar('slug')
            ->requirePresence('slug', 'create')
            ->allowEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table' ,'message'=>'Slug must be unique.']);


        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');


        $validator
            ->scalar('meta_title')
            ->requirePresence('meta_title', 'create')
            ->notEmpty('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->requirePresence('meta_keyword', 'create')
            ->notEmpty('meta_keyword');

        $validator
            ->scalar('meta_description')
            ->requirePresence('meta_description', 'create')
            ->notEmpty('meta_description');

        $validator
            ->allowEmpty('banner_file')
            ->add('banner_file', [
                'fileSize' => [
                    'rule' => ['fileSize', '<=', '50M'],
                    'last' => true,
                    'message' => __('Wrong file size. File size must be below 500 kb.')
                ],
                'validExtension' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .jpeg, .jpg, .gif, .png')
                ]
        ]);

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }

    public function deleteImage($image = '', $record = null)
    {
        if (!empty($image)) {
            $file = new File($this->_dir . $image, false);
            if ($file->exists()) {
                $file->delete();
            }
        }
        if (!empty($record)) {
            $record->banner = '';
            return $this->save($record);
        }
        return true;
    }
    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $trim_ar = ['title', 'meta_keyword', 'meta_title', 'meta_description'];
        foreach ($data as $key => $value) {
            if (in_array($key, $trim_ar)) {
                $data[$key] = trim($value);
            }
        };
    }
}
