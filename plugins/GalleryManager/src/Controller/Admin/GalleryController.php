<?php namespace GalleryManager\Controller\Admin;

use GalleryManager\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Routing\Router;
use Cake\View\Helper\UrlHelper;

/**
 * Gallery Controller
 *
 *
 * @method \GalleryManager\Model\Entity\Gallery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalleryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('GalleryManager.ajax');
        $basepath = 'img/uploads';
        $currentFolder = '';
        $parent = '';
        $imageBoxId = $this->request->getQuery('imageBoxId') != NULL ? $this->request->getQuery('imageBoxId') : 0;
//        pr($this->request->query['directory']);die;
        if ($this->request->getQuery('directory')) {
            $currentFolder = rtrim(str_replace('*', '', $this->request->query['directory']), '/');
            $directory = WWW_ROOT . $basepath . '/' . $currentFolder;
            $pos = strrpos($this->request->getQuery('directory'), '/');

            if ($pos) {
                $parent = (substr($this->request->getQuery('directory'), 0, $pos));
            }
        } else {
            $directory = WWW_ROOT . $basepath;
        }
        $dir = new Folder($directory);
        $gallaries = $dir->read(false, ['.svn']);

        $this->set(compact('gallaries', 'currentFolder', 'basepath', 'parent', 'imageBoxId'));
    }

    /**
     * View method
     *
     * @param string|null $id Gallary id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function folder()
    {
        $basepath = 'img/uploads';
        $currentFolder = '';
        if ($this->request->getQuery('directory')) {
            $currentFolder = rtrim(str_replace('*', '', $this->request->getQuery('directory')), '/');
            $directory = WWW_ROOT . $basepath . $currentFolder;
        } else {
            $directory = WWW_ROOT . $basepath;
        }
        if ($this->request->is('post')) {
            // Sanitize the folder name
            $folder = $this->request->getQuery('folder');

            // Validate the filename length
            if ((strlen($folder) < 3) || (strlen($folder) > 128)) {
                $json['error'] = __('Folder name must be between 3 and 128!');
            }

            // Check if directory already exists or not
            $dir = new Folder($directory . '/' . $folder);
            if (!is_null($dir->path)) {
                $json['error'] = __('A file or directory with the same name already exists!');
            }
        }

        if (!isset($json['error'])) {
            $dir = new Folder($directory . '/' . $folder, true, 0755);
            $json['success'] = __('Directory created!');
        }
        echo json_encode($json);
        die;
    }

    /**
     * Upload method
     *
     * @param string|null $id Gallary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function upload()
    {
        $json = [];
        $basepath = 'img/uploads';
        $currentFolder = '';
        if ($this->request->getQuery('directory')) {
            $currentFolder = rtrim(str_replace('*', '', $this->request->getQuery('directory')), '/');
            $directory = WWW_ROOT . $basepath . '/' . $currentFolder;
        } else {
            $directory = WWW_ROOT . $basepath;
        }
        $directory = str_replace("\\", "/", $directory);
        $fileList = [];
        $data = [];
        if (!$json && $this->request->getData('file')) {
            // Check if multiple files are uploaded or just one
            foreach ($this->request->getData('file') as $file) {
                $upFile = new File($file['tmp_name'], false, 0755);
                // Sanitize the filename
                $filename = basename(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));
                $extension = (new File($file['name'], false))->ext();
                $filenameOrig = str_replace(".{$extension}", '', $file['name']);
                // Validate the filename length
                if (strlen($filenameOrig) > 5) {
                    $filenameOrig = substr($filenameOrig, 0, 5);
                }
                // Allowed file extension types
                $allowed = array('jpg', 'jpeg', 'gif', 'png');
                if (!in_array(strtolower($extension), $allowed)) {
                    $json['error'] = $filename . " " . __('Incorrect file type!');
                }
                // Allowed file mime types
                $is_mime = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif');
                if (!in_array($upFile->mime(), $is_mime)) {
                    $json['error'] = $filename . ' Incorrect file type!';
                }
                // Return any upload error
                if ($file['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $filename . ' error_upload_' . $file['error'];
                }

                if (!$json) {
                    $checkExist = new File($directory . "/" . $filenameOrig . "." . $extension, false);
                    if ($checkExist->exists()) {
                        $filenameOrig = $this->uniqueFileName($directory . "/", $filenameOrig, $extension);
                    }
                    if ($upFile->copy($directory . '/' . $filenameOrig . "." . $extension, TRUE)) {
                        $data[] = ['filename' => $filenameOrig . "." . $extension, 'full_path' => $directory];
                        $fileList[] = "<i class='fa fa-check green'></i> " . $filename . " file successfully uploaded!";
                    } else {
                        $fileList[] = "<i class='fa fa-close red'></i> " . $filename . " file is invalid!";
                        $json['error'] = __($filename . " file is invalid!");
                    }
                } else {
                    $fileList[] = "<i class='fa fa-close red'></i> " . $json['error'];
                }
            }
        }

        $this->set([
            'status' => !$json ? TRUE : FALSE,
            'responce' => 200,
            'message' => $fileList,
            'data' => $data,
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['status', 'responce', 'message', 'data']
        ]);
    }

    private function uniqueFileName($directory, $filenameOrig, $extension)
    {
        $filename = $filenameOrig . "-" . rand(10, 9999);
        $file = new File($directory . $filename . "." . $extension, false);
        if ($file->exists()) {
            $filename = $this->uniqueFileName($directory, $filename, $extension);
        }
        return $filename;
    }

    /**
     * Delete method
     *
     * @param string|null $id Gallary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $json = array();
        $basepath = 'img/uploads';
        $currentFolder = '';
        if ($this->request->getQuery('directory')) {
            $currentFolder = rtrim(str_replace('*', '', $this->request->getQuery('directory')), '/');
            $directory = WWW_ROOT . $basepath . '/' . $currentFolder;
        } else {
            $directory = WWW_ROOT . $basepath;
        }
        $directory = str_replace("\\", "/", $directory);
        if ($this->request->getData('path')) {
            $paths = $this->request->getData('path');
        } else {
            $paths = [];
        }
        if (!$json) {
            // Loop through each path
            foreach ($paths as $path) {
                $path = rtrim($directory . '/' . $path, '/');
                // If path is just a file delete it
                if (is_file($path)) {
                    $file = new File($path);
                    $file->delete();
                } elseif (is_dir($path)) {
                    $folder = new Folder($path);
                    if (!$folder->delete()) {
                        $json['error'] = __("Directory not deleted!");
                    }
                }
            }

            $json['success'] = __("Successfully deleted!");
        }
        echo json_encode($json);
        die;
    }

    /**
     * Upload method
     *
     * @param string|null $id Gallary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function ckeditor()
    {
        $json = [];
        $basepath = 'img/uploads';
        $currentFolder = '';
        if ($this->request->getQuery('directory')) {
            $currentFolder = rtrim(str_replace('*', '', $this->request->getQuery('directory')), '/');
            $directory = WWW_ROOT . $basepath . '/' . $currentFolder;
            if (!is_dir($basepath . '/' . $currentFolder)) {
                mkdir($basepath . '/' . $currentFolder, 0777, true);
            }
        } else {
            $directory = WWW_ROOT . $basepath;
        }
        $directory = str_replace("\\", "/", $directory);
        $CKEditorFuncNum = $this->request->getQuery('CKEditorFuncNum');

        $fileList = [];
        $data = [];
        if (!$json && $this->request->getData('upload')) {
            // Check if multiple files are uploaded or just one
            $file = $this->request->getData('upload');
            $upFile = new File($file['tmp_name'], false, 0755);
            // Sanitize the filename
            $filename = basename(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));
            $extension = (new File($file['name'], false))->ext();
            $filenameOrig = str_replace(".{$extension}", '', $file['name']);
            // Validate the filename length
            if (strlen($filenameOrig) > 5) {
                $filenameOrig = substr($filenameOrig, 0, 5);
            }
            // Allowed file extension types
            $allowed = array('jpg', 'jpeg', 'gif', 'png');
            if (!in_array(strtolower($extension), $allowed)) {
                $json['error'] = $filename . " " . __('Incorrect file type!');
            }
            // Allowed file mime types
            $is_mime = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif');
            if (!in_array($upFile->mime(), $is_mime)) {
                $json['error'] = $filename . ' Incorrect file type!';
            }
            // Return any upload error
            if ($file['error'] != UPLOAD_ERR_OK) {
                $json['error'] = $filename . ' error_upload_' . $file['error'];
            }

            if (!$json) {
                $checkExist = new File($directory . "/" . $filenameOrig . "." . $extension, false);
                if ($checkExist->exists()) {
                    $filenameOrig = $this->uniqueFileName($directory . "/", $filenameOrig, $extension);
                }
                if ($upFile->copy($directory . '/' . $filenameOrig . "." . $extension, TRUE)) {
//                        $data[] = ['filename'=> $filenameOrig . "." . $extension, 'full_path'=> $directory ];
//                        $fileList[] = "<i class='fa fa-check green'></i> ". $filename . " file successfully uploaded!";
                    //$url = $directory . '/' . $filenameOrig . "." . $extension;
                    $url = Router::url('/', true) . $basepath . '/' . $currentFolder . "/" . $filenameOrig . "." . $extension;
                    $message = $filenameOrig . ' successfully uploaded: \\n- Size: ' . number_format($upFile->size() / 1024, 3, '.', '') . ' KB ';
                    $re = "window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')";
                } else {
                    $re = 'alert("' . $filename . ' file is invalid!")';
                }
            } else {
                $re = 'alert("' . $json['error'] . '")';
            }
        } else {
            $re = 'alert("invalid image")';
        }

        echo "<script>$re;</script>";
        die();
    }
}
