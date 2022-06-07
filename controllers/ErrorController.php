<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\rest4matchbook\controllers;
use humhub\modules\rest4matchbook\components\BaseController;


/**
 * Class ErrorController
 */
class ErrorController extends BaseController
{
    public function actionNotfound()
    {
        return $this->returnError(404, 'Requested action not found!');
    }
}