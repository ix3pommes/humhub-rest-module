<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */

return [
    'modules' => ['rest4matchbook'],
    'fixtures' => [
        'default',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\ActivityFixture',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\CommentFixture',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\ContentFixture',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\FileFixture',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\LikeFixture',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\NotificationFixture',
        'humhub\modules\rest4matchbook\tests\codeception\fixtures\TopicFixture',
    ]
];



