<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html>
    <head>
       <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0 0;
                width: 795px;
                height: 1020px;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
               margin: 0 0;
            }
            .mainwrapar{
                background:url(<?= $this->Url->image('orign.jpg', ['fullBase' => true,]); ?>);
                background-repeat:no-repeat;
                background-position: top right;
                width: 795px;
                height: 1020px;
                margin:auto;
                background-size: contain;
            }
            .maincontant{ 
                
            }
         
        </style>
    </head>
    <body class="">
        <?= $this->fetch('content') ?>
    </body>
</html>
