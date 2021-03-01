<?php

namespace SettingManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Symfony\Component\Yaml\Yaml;

/**
 * Settings Model
 *
 * @method \SettingManager\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \SettingManager\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \SettingManager\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \SettingManager\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \SettingManager\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \SettingManager\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \SettingManager\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SettingsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $_dir;

    public function initialize(array $config) {
        parent::initialize($config);
        $this->_dir = 'img' . DS . 'uploads' . DS . 'settings' . DS;
        $this->setTable('settings');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
       
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('title')
                ->maxLength('title', 150)
                ->requirePresence('title', 'create')
                ->notEmpty('title', 'Title is required field.');

        $validator
                ->scalar('slug')
                ->requirePresence('slug', 'create')
                ->notEmpty('slug','Constant/Slug is required field.')
                ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'This Constant/Slug already exists.']);

        $validator
                ->scalar('config_value')
                ->requirePresence('config_value', 'create')
                ->notEmpty('config_value', 'Config Value is required field.');

        $validator
                ->scalar('manager')
                ->maxLength('manager', 255)
                ->requirePresence('manager', 'create')
                ->notEmpty('manager');

        $validator
                ->scalar('field_type')
                ->maxLength('field_type', 255)
                ->requirePresence('field_type', 'create')
                ->notEmpty('field_type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['slug']));
        return $rules;
    }

    /**
     * before marshal used for trim whitspace for all form element
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function beforeMarshal(Event $event, ArrayObject $data) {
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $data[$key] = trim($value);
            }
        };
        if (isset($data['manager']) && $data['manager'] == "social") {
            $sort_arr = [];
            foreach ($data['title'] as $num => $title) {
                $sort_arr[] = ['icon' => $data['icon'][$num], 'url' => $data['url'][$num], 'title' => $title];
            }
            $data['title'] = 'Social Icons';
            $data['slug'] = 'SOCIAL_LINKS';
            $data['config_value'] = json_encode($sort_arr);
        }
    }

    public function afterSave(Event $event, EntityInterface $entity, ArrayObject $options) {
//        if ($entity->manager == "theme_images") {
//            $folder = new Folder(WWW_ROOT);
//            $uploadPath = trim($this->_dir, DS);
//            $folder->create(WWW_ROOT . $uploadPath);
//            $file = new File(WWW_ROOT . "img" . DS . "tmp" . DS . $entity->get('config_value'), false, 0755);
//            if ($file->exists()) {
//                $file->copy($folder->path . $uploadPath . DS . $file->name, true);
//                $file->delete();
//                if (!$entity->isNew() && $entity->get('config_value') != $entity->getOriginal('config_value')) {
//                    $oldfile = new File($folder->path . $uploadPath . DS . $entity->getOriginal('config_value'), false, 0755);
//                    if ($oldfile->exists()) {
//                        $oldfile->delete();
//                    }
//                }
//            }
//        } else if ($entity->manager == "social") {
//            $folder = new Folder(WWW_ROOT);
//            $uploadPath = trim($this->_dir, DS);
//            $folder->create(WWW_ROOT . $uploadPath);
//            $file = new File(WWW_ROOT . "img" . DS . "tmp" . DS . $entity->get('file'), false, 0755);
//            if ($file->exists()) {
//                $file->copy($folder->path . $uploadPath . DS . $file->name, true);
//                $file->delete();
//                if (!$entity->isNew() && $entity->get('file') != $entity->getOriginal('file')) {
//                    $oldfile = new File($folder->path . $uploadPath . DS . $entity->getOriginal('file'), false, 0755);
//                    if ($oldfile->exists()) {
//                        $oldfile->delete();
//                    }
//                }
//            }
//        }
        $this->yamlParse();
    }

    public function afterDelete(Event $event, EntityInterface $entity, ArrayObject $options) {
        if ($entity->manager == "theme_images") {
            $file = new File($this->_dir . $entity->get('config_value'), false, 0755);
            if ($file->exists()) {
                $file->delete();
            }
        } else if ($entity->manager == "social") {
//            $config_array = json_decode($entity->config_value, true);
//            if (isset($config_array['file'])) {
//                $file = new File($this->_dir . $config_array['file'], false, 0755);
//                if ($file->exists()) {
//                    $file->delete();
//                }
//            }
        }
        $this->yamlParse();
    }

    public function yamlParse() {
        $conditions = ['OR' => [['manager IS' => NULL], ['manager' => 'general'], ['manager' => 'social'], ['manager' => 'options'], ['manager' => 'smtp'], ['manager' => 'theme_images']]];
        $lists = $this->find('list', ['keyField' => 'slug', 'valueField' => 'config_value'])->where($conditions)->order(['slug' => 'ASC'])->toArray();
        $listYaml = Yaml::dump($lists, 4, 60);
        $filePath = ROOT . DS . 'config' . DS . 'settings.yml';
        $file = new File($filePath, true);
        $file->write($listYaml);
    }

}
