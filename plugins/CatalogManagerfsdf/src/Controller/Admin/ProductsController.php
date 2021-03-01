<?php namespace CatalogManager\Controller\Admin;

use CatalogManager\Controller\AppController;
use Cake\Routing\Router;
/**
 * Products Controller
 *
 * @property \CatalogManager\Model\Table\ProductsTable $Products
 *
 * @method \CatalogManager\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $_dir = str_replace("\\", "/", $this->Products->_dir);
		$this->set(compact('_dir'));
       
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Products->find();
        $query->contain(['StockStatuses']);

        $options['order'] = ['Products.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $products = $this->paginate($query);
        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['StockStatuses', 'Categories', 'Tags', 'ProductDiscounts', 'ProductImages', 'ProductOptions', 'ProductSpecials', 'RelatedProducts']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if ($id) {
            $product = $this->Products->get($id, [
                'contain' => ['Categories', 'Tags','ProductDiscounts','ProductImages','ProductSpecials','RelatedProducts'=>['Relateds'=>['fields'=>['Relateds.id','Relateds.title']]]]
            ]);
        } else {
            $product = $this->Products->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            //pr($product->errors());die;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $stockStatuses = $this->Products->StockStatuses->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('treeList', ['spacer' => '_', 'conditions' => ['status' => 1]]);
        $tags = $this->Products->Tags->find('list', ['limit' => 200]);
        $this->set(compact('product', 'stockStatuses', 'categories', 'tags'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * ChangeFlag method
     *
     * @param string|null &id flag id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Products->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Products->save($status)) {
                $msg = $this->request->getData($field) == 1 ? __("Your {$field} has activated") : __("Your {$field} has deactivated");
                $response = ["success" => true, "err_msg" => $msg];
            } else {
                $response = ["success" => false, "err_msg" => __("Your Process faild. please try again!!")];
            }
            $this->set([
                'success' => $response['success'],
                'responce' => 200,
                'message' => $response['err_msg'],
                '_jsonOptions' => JSON_FORCE_OBJECT,
                '_serialize' => ['success', 'responce', 'message']
            ]);
        }
    }

    /*
     * Please delete this function after confirmation
     */
    public function deletediscount($id = null) {
        if ($this->request->is('ajax')) {
            if (isset($_POST) && !empty($_POST)) {
                $this->loadModel('ProductDiscounts');
                $discount = $this->ProductDiscounts->get($_POST['id']);
                if ($this->ProductDiscounts->delete($discount)) {
                    die(json_encode(array("success" => true, "err_msg" => "Discount has been deleted")));
                } else {
                    die(json_encode(array("success" => false, "err_msg" => "process faild please try again!!")));
                }
            }
            die;
        }
    }
    
	/*
     * Please delete this function after confirmation
     */
	public function deletespdiscount($id = null) {
        if ($this->request->is('ajax')) {
            if (isset($_POST) && !empty($_POST)) {
                $this->loadModel('ProductSpecials');
                $discount = $this->ProductSpecials->get($_POST['id']);
                if ($this->ProductSpecials->delete($discount)) {
                    die(json_encode(array("success" => true, "err_msg" => "Special Discount has been deleted")));
                } else {
                    die(json_encode(array("success" => false, "err_msg" => "process faild please try again!!")));
                }
            }
            die;
        }
    }
    
    /**
     * Upload method
     *
     * Upload files in temp file
     * Need to change this function this is not good.
     */
    public function tempfiles()
    {
        $dir = "img/tmp/";
        $name = array();
        if (isset($_FILES['file']) && !empty($_FILES['file'])) {
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $ext = pathinfo($_FILES['file']["name"], PATHINFO_EXTENSION);
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array(strtolower($ext), $allowed)) {
                $ran = time();
                $upload_img = $ran . "_" . $_FILES['file']["name"];
                if (strlen($upload_img) > 80) {
                    $upload_img = $ran . "_" . rand() . "." . $ext;
                }
                $upload_img = str_replace(' ', '_', $upload_img);
                if (move_uploaded_file($_FILES['file']["tmp_name"], $dir . $upload_img)) {
                    if (file_exists($dir . $upload_img) && $upload_img != "") {
                        $image = Router::url("/", true) . 'tim-thumb/timthumb.php?src=' . $this->request->webroot . "webroot/" . $dir . $upload_img . '&w=100&h=100&a=t&q=100';
                    } else {
                        $image = Router::url("/", true) . 'tim-thumb/timthumb.php?src=' . $this->request->webroot . "webroot/" . 'img/noimage.jpg&w=100&h=100&iar=1';
                    }
                    $imagepath = "";
                    $name = array("success" => true, "data" => array("imagepath" => $image, "name" => $upload_img));
                } else {
                    $name = array("success" => false, "data" => array($_FILES['file']["name"] . " Invalid File Please upload another image file."));
                }
            } else {
                $name = array("success" => false, "data" => array($_FILES['file']["name"] . " Invalid file Only JPG, GIF, PNG file type are allowed."));
            }
        }
        die(json_encode($name));
    }
}
