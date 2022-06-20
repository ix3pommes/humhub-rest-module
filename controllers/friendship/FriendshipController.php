<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 * @author Usama Ayaz <usama.ayaz@siliconplex.com>
 */

namespace humhub\modules\rest4matchbook\controllers\friendship;

use humhub\modules\rest4matchbook\components\BaseController;
use humhub\modules\rest4matchbook\definitions\FriendshipDefinitions;
use humhub\modules\friendship\models\Friendship;
use humhub\modules\user\models\User;
use Yii;
use yii\web\HttpException;

/**
 * Friendship Controller
 */
class FriendshipController extends BaseController {

    public function actionIndex()
    {
        $currentUser = User::findOne(['id' => Yii::$app->user->id]);
        $query = Friendship::getFriendsQuery($currentUser);

        $results = [];
        $pagination = $this->handlePagination($query);
        foreach ($query->all() as $user) {
            $results[] = FriendshipDefinitions::getFriend($user);
        }
        return $this->returnPagination($query, $pagination, $results);
    }

    public function actionGetSentRequests()
    {
        $currentUser = User::findOne(['id' => Yii::$app->user->id]);
        $query = Friendship::getSentRequestsQuery($currentUser);

        $pagination = $this->handlePagination($query);
        $results = [];
        foreach ($query->all() as $user) {
            $results[] = FriendshipDefinitions::getFriend($user);
        }
        return $this->returnPagination($query, $pagination, $results);
    }

    public function actionGetReceivedRequests()
    {
        $currentUser = User::findOne(['id' => Yii::$app->user->id]);
        $query = Friendship::getReceivedRequestsQuery($currentUser);

        $pagination = $this->handlePagination($query);
        $results = [];
        foreach ($query->all() as $user) {
            $results[] = FriendshipDefinitions::getFriend($user);
        }
        return $this->returnPagination($query, $pagination, $results);
    }

    public function actionSendRequest()
    {
        $friendId = Yii::$app->request->post('friendId');
        $friend = User::findOne(['id' => $friendId]);
        if ($friend === null) {
            throw new HttpException(404, 'Friend User with id '. $friendId . ' not found!');
        }

        $currentUser = User::findOne(['id' => Yii::$app->user->id]);
        if ($currentUser->id === $friend->id) {
            throw new HttpException(404, 'You cannot send request to yourself!');
        }

        $friendship = Friendship::add($currentUser, $friend);
        if ($friendship) {
            return $this->returnSuccess('Friendship request sent', 200, ['friendship' => $friendship]);
        }
        return $this->returnError(500, 'Friendship request failed', ['friendship' => $friendship]);
    }

    public function actionSendCancel()
    {
        $friendId = Yii::$app->request->post('friendId');
        $friend = User::findOne(['id' => $friendId]);
        if ($friend === null) {
            throw new HttpException(404, 'Friend User with id '. $friendId . ' not found!');
        }

        $currentUser = User::findOne(['id' => Yii::$app->user->id]);
        Friendship::cancel($currentUser, $friend);

        return $this->returnSuccess('Friendship canceled');
    }

}