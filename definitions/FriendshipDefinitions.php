<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\rest4matchbook\definitions;

use humhub\modules\friendship\models\Friendship;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\User;
use yii\helpers\Url;

class FriendshipDefinitions
{

    public static function getFriend(User $user) {

        return [
            UserDefinitions::getUser($user)
        ];
    }

    public static function getFriendship(Friendship $friendship) {

        return [
            'id' => $friendship->id,
            'created_at' => $friendship->created_at,
            'friend' => UserDefinitions::getUserShort($friendship->friendUser),
            'user' => UserDefinitions::getUserShort($friendship->user)

        ];
    }
}

