<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\rest4matchbook\tests\codeception\fixtures;

use humhub\modules\activity\models\Activity;
use yii\test\ActiveFixture;

class ActivityFixture extends ActiveFixture
{

    public $modelClass = Activity::class;
    public $dataFile = '@rest4matchbook/tests/codeception/fixtures/data/activity.php';

}
