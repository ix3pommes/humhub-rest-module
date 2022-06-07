<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

use humhub\components\Application;

/** @noinspection MissedFieldInspection */
return [
    'id' => 'rest4matchbook',
    'class' => 'humhub\modules\rest4matchbook\Module',
    'namespace' => 'humhub\modules\rest4matchbook',
    'events' => [
        [Application::class, Application::EVENT_BEFORE_REQUEST, ['\humhub\modules\rest4matchbook\Events', 'onBeforeRequest']]
    ]
];
?>