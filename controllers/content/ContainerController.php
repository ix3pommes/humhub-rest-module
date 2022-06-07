<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\rest4matchbook\controllers\content;

use humhub\modules\rest4matchbook\components\BaseController;
use humhub\modules\rest4matchbook\definitions\ContentDefinitions;
use humhub\modules\content\models\ContentContainer;


class ContainerController extends BaseController
{

    public function actionList()
    {
        $results = [];
        $query = ContentContainer::find();
        $pagination = $this->handlePagination($query);

        foreach ($query->all() as $container) {
            $results[] = ContentDefinitions::getContentContainer($container);
        }

        return $this->returnPagination($query, $pagination, $results);
    }



}