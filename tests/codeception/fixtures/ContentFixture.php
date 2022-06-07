<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\rest4matchbook\tests\codeception\fixtures;

use humhub\modules\content\models\Content;
use yii\test\ActiveFixture;

class ContentFixture extends ActiveFixture
{

    public $modelClass = Content::class;
    public $dataFile = '@rest4matchbook/tests/codeception/fixtures/data/content.php';

}
