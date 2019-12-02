<?php
/**
 * Created by PhpStorm.
 * User: foxett
 * Date: 11/28/2019
 * Time: 18:37
 */
require_once 'models/BaseModel.php';
require_once 'views/BaseView.php';
require_once 'controllers/BaseController.php';
require_once 'controllers/MainController.php';
require_once 'services/ProductService.php';
require_once 'models/ProductModel.php';
require_once 'controllers/OrderController.php';
require_once 'models/OrderModel.php';
require_once 'services/OrderService.php';
require_once 'models/OrderProductsModel.php';
require_once 'database/DB.php';
require_once 'routes.php';
Route::init();