<?php


//$uniqueno = "YADU" .str_pad(($quotation->id), 8, "0", STR_PAD_LEFT); lata


namespace ListingManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use ArrayObject;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\Mailer\MailerAwareTrait;
use Cake\Core\Configure;
/**
 * Listings Model
 *
 * @property \ListingManager\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \ListingManager\Model\Table\PropertyTypesTable|\Cake\ORM\Association\BelongsTo $PropertyTypes
 * @property \ListingManager\Model\Table\ListingImagesTable|\Cake\ORM\Association\HasMany $ListingImages
 * @property \ListingManager\Model\Table\AmenitiesTable|\Cake\ORM\Association\BelongsToMany $Amenities
 *
 * @method \ListingManager\Model\Entity\Listing get($primaryKey, $options = [])
 * @method \ListingManager\Model\Entity\Listing newEntity($data = null, array $options = [])
 * @method \ListingManager\Model\Entity\Listing[] newEntities(array $data, array $options = [])
 * @method \ListingManager\Model\Entity\Listing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ListingManager\Model\Entity\Listing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ListingManager\Model\Entity\Listing[] patchEntities($entities, array $data, array $options = [])
 * @method \ListingManager\Model\Entity\Listing findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListingsTable extends Table
{

    use MailerAwareTrait;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $_dir;
	public $baseUrl;
    public $baseAdminUrl;

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->_dir = 'img' . DS . 'uploads' . DS . 'listings' . DS . 'documents' . DS;
        $this->baseUrl = "http://www.rentanyproperty.co.uk/";
        $this->baseAdminUrl = "http://admin.rentanyproperty.co.uk/";
        $this->setTable('listings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users'
        ]);
        $this->belongsTo('PropertyTypes', [
            'foreignKey' => 'property_type_id',
            'joinType' => 'LEFT',
            'className' => 'ListingManager.PropertyTypes'
        ]);
        $this->hasMany('ListingImages', [
            'foreignKey' => 'listing_id',
            'className' => 'ListingManager.ListingImages',
            'sort' => ['ListingImages.sort_order' => 'ASC'],
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('UserFavourites', [
            'foreignKey' => 'listing_id',
            'className' => 'UserFavourites',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('ListingDocuments', [
            'foreignKey' => 'listing_id',
            'className' => 'ListingManager.ListingDocuments',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

         $this->hasOne('MyFavourites', [
            'foreignKey' => 'listing_id',
            'className' => 'UserFavourites',
        ]);


        $this->hasOne('ActivePlan', [
            'foreignKey' => 'listing_id',
            'className' => 'ListingMemberships',
            'conditions' => ['ActivePlan.is_active' => 1],
        ]);

        $this->hasMany('ListingMemberships', [
            'foreignKey' => 'listing_id',
            'className' => 'ListingManager.ListingMemberships',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);


         $this->hasMany('GasSafeties', [
            'foreignKey' => 'listing_id',
            'className' => 'GasSafeties'
        ]);


          $this->hasMany('EnergyPerformances', [
            'foreignKey' => 'listing_id',
            'className' => 'EnergyPerformances'
        ]);


          $this->hasMany('ProPhotographies', [
            'foreignKey' => 'listing_id',
            'className' => 'ProPhotographies'
        ]);



        $this->hasOne('GasSafetiesOne', [
            'foreignKey' => 'listing_id',
            'className' => 'GasSafeties',
            'conditions' => ['GasSafetiesOne.is_paid' => 0],
        ]);


          $this->hasOne('EnergyPerformancesOne', [
            'foreignKey' => 'listing_id',
            'className' => 'EnergyPerformances',
            'conditions' => ['EnergyPerformancesOne.is_paid' => 0],
        ]);


          $this->hasOne('ProPhotographiesOne', [
            'foreignKey' => 'listing_id',
            'className' => 'ProPhotographies',
            'conditions' => ['ProPhotographiesOne.is_paid' => 0],
        ]);


          $this->hasMany('ElectricSafeties', [
            'foreignKey' => 'listing_id',
            'className' => 'ElectricSafeties'
        ]);

        $this->hasMany('ListingTenants', [
            'foreignKey' => 'listing_id',
            'className' => 'ListingManager.ListingTenants'
        ]);


        $this->belongsToMany('Amenities', [
            'foreignKey' => 'listing_id',
            'targetForeignKey' => 'amenity_id',
            'joinTable' => 'listings_amenities',
            'className' => 'ListingManager.Amenities'
        ]);

        $this->addBehavior('Slug', [
            'field' => 'slug',
            ]
        );
        $this->addBehavior('RandomString', [
            'field' => 'unique_listingId',
            'case'=>'upper'
            ]
        );

        $this->addBehavior('Chris48s/GeoDistance.GeoDistance', [
            'latitudeColumn' => 'latitude',
            'longitudeColumn' => 'longitude',
            'units' => 'km'
        ]);


        $this->addBehavior('Upload', [
            'fields' => [
                'epc_document' => [
                    'path' => $this->_dir . ':name'
                ],
                'floor_plan_document' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
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

//        $validator
//            ->scalar('unique_listingId')
//            ->maxLength('unique_listingId', 100)
//            ->requirePresence('unique_listingId', 'create')
//            ->notEmpty('unique_listingId','Unique ID is required');

//        $validator
//            ->scalar('slug')
//            ->maxLength('slug', 250)
//            ->requirePresence('slug', 'create')
//            ->notEmpty('slug')
//            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('bedrooms')
            ->requirePresence('bedrooms', 'create')
            ->notEmpty('bedrooms','Bedrooms is required');

        $validator
            ->integer('bathrooms')
            ->requirePresence('bathrooms', 'create')
            ->notEmpty('bathrooms','Bathrooms is required');

        $validator
            ->integer('furnished_type')
            ->requirePresence('furnished_type', 'create')
            ->notEmpty('furnished_type','Furnishing Options is required');


        $validator
            ->decimal('monthly_rent')
            ->requirePresence('monthly_rent', 'create')
            ->notEmpty('monthly_rent');
//
//        $validator
//            ->decimal('deposit_amount')
//            ->requirePresence('deposit_amount', 'create')
//            ->notEmpty('deposit_amount');

        $validator
            ->integer('minimum_tenancy')
            ->requirePresence('minimum_tenancy', 'create')
            ->notEmpty('minimum_tenancy','Minimum tenancy length is required');



        $validator
            ->integer('maximum_tenancy')
            ->allowEmpty('maximum_tenancy');



        $validator
            ->scalar('post_code')
            ->maxLength('post_code', 15)
            ->requirePresence('post_code', 'create')
            ->notEmpty('post_code');

        $validator
            ->scalar('house_number')
            ->maxLength('house_number', 100)
            ->requirePresence('house_number', 'create')
            ->notEmpty('house_number');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 255)
            ->requirePresence('address_line_2', 'create')
            ->allowEmpty('address_line_2');

        $validator
            ->scalar('address_line_3')
            ->maxLength('address_line_3', 255)
            ->allowEmpty('address_line_3');

//        $validator
//            ->scalar('town')
//            ->maxLength('town', 255)
//            ->requirePresence('town', 'create')
//            ->notEmpty('town');
//
//        $validator
//            ->scalar('country')
//            ->maxLength('country', 255)
//            ->allowEmpty('country');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 100)
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude','Latitude is required');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 100)
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude','Longitude is required');


//        $validator
//            ->scalar('short_description')
//            //->maxLength('short_description', 255)
//            ->requirePresence('short_description', 'create')
//            ->notEmpty('short_description');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description','Description is required');


//        $validator
//            ->boolean('status')
//            ->requirePresence('status', 'create')
//            ->notEmpty('status');

        return $validator;
    }

     public function validationDocuments(Validator $validator)
    {
        $validator
            ->requirePresence('epc_document_file', function ($context) {
                if (isset($context['data']['epc_document_file'])) {
                    return !empty($context['data']['epc_document_file']);
                }
                return false;
            })
            ->allowEmpty('epc_document_file')
            ->add('epc_document_file', [
                'validExtension' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg','pdf']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .jpeg, .jpg, .gif, .png, .pdf')
                ]
            ]);

            $validator
            ->requirePresence('floor_plan_document_file', function ($context) {
                if (isset($context['data']['floor_plan_document_file'])) {
                    return !empty($context['data']['floor_plan_document_file']);
                }
                return false;
            })
            ->allowEmpty('floor_plan_document_file')
            ->add('floor_plan_document_file', [
                'validExtension' => [
                    'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .jpeg, .jpg, .gif, .png')
                ]
            ]);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['property_type_id'], 'PropertyTypes'));

        return $rules;
    }

    public function beforeMarshal(Event $event, ArrayObject $data) {

        if(isset($data['property_type_id']) && !empty($data['property_type_id'])){
            $ptype = $this->PropertyTypes->find()->where(['PropertyTypes.id' => $data['property_type_id']])->first();
            if(!empty($ptype)){
                $data['slug'] = $ptype->title ." ".$data['house_number']." ".$data['address_line_2']." ".$data['town'];
            }
        }
        if(isset($data['is_membership']) && !empty($data['is_membership'])){
            $memPlan = [];
            $membership = TableRegistry::getTableLocator()->get('MembershipManager.Memberships');
            $getMem = $membership->find()->where(['Memberships.id' => $data['is_membership']])->first();
            if(!empty($getMem)){
                if($getMem->total_days){
                    $date = new Date();
                    $start_date = $date->format('Y-m-d');
                    $date->modify('+'.$getMem->total_days.' months');
                    $end_date = $date->format('Y-m-d');
                    $memPlan[] = ['membership_id' => $data['is_membership'], 'amount' => $getMem->amount, 'start_date' => $start_date, 'end_date' => $end_date, 'is_active' => ($getMem->amount == 0) ? 1 : 0 ];
                    $data['listing_memberships'] = $memPlan;
                    if($getMem->amount > 0){
                        $data['redirect_topay'] = true;
                    }
                }
            }
        }
        if(isset($data['is_prophotograph']) && !empty($data['is_prophotograph'])){
            $data['redirect_topay'] = true;
        }else if(isset($data['is_energy_certificate']) && $data['is_energy_certificate'] == 1){
            $data['redirect_topay'] = true;
        }else if(isset($data['is_safety_certificate']) && $data['is_safety_certificate'] == 1){
            $data['redirect_topay'] = true;
        }
        if((isset($data['redirect_topay']) && $data['redirect_topay'] === true) && isset($data['is_finalsubmission'])){
            unset($data['is_finalsubmission']);
        }

		//pr($data);

		if(isset($data['is_finalsubmission']) && $data['is_finalsubmission'] == '1'){
			$data['is_publish'] = true;
		}

		if(isset($data['from_relist']) && $data['from_relist'] == true && isset($data['is_finalsubmission']) && $data['is_finalsubmission'] == 1){
		    $data['is_rentout'] = 0;
            $data['status'] = 0;
		    $data['is_new'] = 0;
		}

		//pr($data);
		//die();


    }

    public function afterSave(Event $event, EntityInterface $entity)
    {
        if ($entity->get('is_publish') == 1 && ($entity->get('is_publish') != $entity->getOriginal('is_publish'))) {

		   // Mail will goes to user

				$fullUrl = $this->baseUrl.'users/listings/uploads/'.$entity->slug;
				$replacement = [
					'##USER_NAME##' => $entity->user->first_name,
					'##ATTACH_DOCUMENT##' => $fullUrl
				];
				$messageTemplate = $this->buildMessage('new-property-publish', $replacement);
				$subject = $messageTemplate['subject'];
				$template = $messageTemplate['message'];
				$emailTo = $entity->user->email;

				$this->CronEmails = TableRegistry::get('CronEmails');
				$cronEmailData = array();
				$cronEmail = $this->CronEmails->newEntity();
				$cronEmailData['sender'] = Configure::read('Setting.FROM_EMAIL') != null ? Configure::read('Setting.FROM_EMAIL') : "testsupport@domain.com";
				$cronEmailData['receiver'] = $emailTo;
				$cronEmailData['subject'] = $subject;
				$cronEmailData['template'] = $template;
				if (!empty($entity->user->mobile) && $entity->user->mobile_verified == 1) {
					$cronEmailData['mobile'] = $entity->user->mobile;
				}
				$cronEmailData['message'] = $subject;
				$listingInquiry = $this->CronEmails->patchEntity($cronEmail, $cronEmailData);
				$this->CronEmails->save($listingInquiry);

			// Mail will goes to admin

				$fullUrl = $this->baseAdminUrl.'admin/listing-manager/listings/view/'.$entity->id;
				$replacement = [
					'##USER_NAME##' => $entity->user->first_name,
					'##PROPERTY_URL##' => $fullUrl
				];
				$messageTemplate = $this->buildMessage('new-property-notifiaction', $replacement);
				$subject = $messageTemplate['subject'];
				$template = $messageTemplate['message'];
				$emailTo = Configure::read('Setting.ADMIN_EMAIL');

				$this->CronEmails = TableRegistry::get('CronEmails');
				$cronEmailData = array();
				$cronEmail2 = $this->CronEmails->newEntity();
				$cronEmailData['sender'] = Configure::read('Setting.FROM_EMAIL') != null ? Configure::read('Setting.FROM_EMAIL') : "testsupport@domain.com";
				$cronEmailData['receiver'] = $emailTo;
				$cronEmailData['subject'] = $subject;
				$cronEmailData['template'] = $template;
				if (!empty($entity->user->mobile) && $entity->user->mobile_verified == 1) {
					$cronEmailData['mobile'] = $entity->user->mobile;
				}
				$cronEmailData['message'] = $subject;
				$listingInquiry2 = $this->CronEmails->patchEntity($cronEmail2, $cronEmailData);
				$this->CronEmails->save($listingInquiry2);

        }
    }


	public function buildMessage($email_type, $replacement = null)
    {

        $email_template = TableRegistry::get('EmailManager.EmailTemplates');
        $query = $email_template->find('hook', ['slug' => $email_type]);
        $template = $query->first();
        $fullUrl = $this->baseAdminUrl;
         $default_replacement = [
            '##SYSTEM_APPLICATION_NAME##' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
            '##BASE_URL##' => $fullUrl,
            '##SYSTEM_LOGO##' => $fullUrl . 'img/' . Configure::read('Setting.MAIN_LOGO'),
            '##COPYRIGHT_TEXT##' => "Copyright " . Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " " . date("Y"),
        ];
        $message_body = str_replace('##EMAIL_CONTENT##', $template->description, $template->email_preference->layout_html);
        $message_body = str_replace('##EMAIL_FOOTER##', $template->footer_text, $message_body);
        $message_body = strtr($message_body, $default_replacement);
        $message_body = strtr($message_body, $replacement);
        $subject = strtr($template->subject, $default_replacement);
        $subject = strtr($subject, $replacement);
        $message = ['message' => $message_body, 'subject' => $subject];
        return $message;
    }




    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                $conc = $q->func()->concat(['Listings.house_number' => 'identifier', ', ', 'Listings.address_line_2' => 'identifier', ', ','Listings.address_line_3' => 'identifier', ', ', 'Listings.town' => 'identifier']);
                return $exp->or_([
                        'Listings.unique_listingId LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.post_code LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.house_number LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.address_line_2 LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.address_line_3 LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.town LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.description LIKE' => '%' . trim($options['keyword']) . '%',
                        'Listings.short_description LIKE' => '%' . trim($options['keyword']) . '%',
                    ])->like($conc, '%' . trim($options['keyword']) . '%');
            });
        }

        if (isset($options['status']) && $options['status'] != "") {
            $query->where(['Listings.status' => $options['status']]);
        }
        if (isset($options['bedrooms']) && !empty($options['bedrooms'])) {
            $query->where(['Listings.bedrooms' => (int)$options['bedrooms']]);
        }
        if (isset($options['bathrooms']) && $options['bathrooms'] != "") {
            $query->where(['Listings.bathrooms' => $options['bathrooms']]);
        }
        if (isset($options['furnished_type']) && $options['furnished_type'] != "") {
            $query->where(['Listings.furnished_type' => $options['furnished_type']]);
        }
        if (isset($options['parking_space ']) && $options['parking_space'] != "") {
            $query->where(['Listings.parking_space' => $options['parking_space']]);
        }

        if (isset($options['property_type_id']) && $options['property_type_id'] != "") {
            $query->innerJoinWith('PropertyTypes', function($q) use($options) {
                return $q->where(['PropertyTypes.id' => $options['property_type_id']]);
            });
        }
        return $query;
    }


    public function findActive(Query $query, array $options)
    {
        return $query->where(['Listings.status' => 1]);
    }

    public function findMovedin(Query $query, array $options)
    {
        return $query->where(['Listings.moved_in' => 0]);
    }

    public function findRentout(Query $query, array $options)
    {
        return $query->where(['Listings.is_rentout !=' => 1]);
    }

    public function findPublished(Query $query, array $options)
    {
        return $query->where(['Listings.is_publish' => 1]);
    }

}
