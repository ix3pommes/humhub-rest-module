<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\rest4matchbook;

use humhub\components\Event;
use Yii;

class Events
{
    public static function onBeforeRequest($event)
    {

        // Only prepare if API request
        if (substr(Yii::$app->request->pathInfo, 0, 4) != 'api/') {
            return;
        }

        // JSON for all API requests except the API configuration
        if (substr(Yii::$app->request->pathInfo, 0, 9) != 'rest4matchbook/admin') {
            Yii::$app->response->format = 'json';
        }

        /* @var Module $module */
        $module = Yii::$app->getModule('rest4matchbook');
        $module->addRules([

            // Auth
            ['pattern' => 'auth/login/', 'route' => 'rest4matchbook/auth/auth/index', 'verb' => ['POST']],
            ['pattern' => 'auth/current', 'route' => 'rest4matchbook/auth/auth/current', 'verb' => ['GET', 'HEAD']],

            // User: Default Controller
            ['pattern' => 'user/', 'route' => 'rest4matchbook/user/user/index', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'user/get-by-username', 'route' => 'rest4matchbook/user/user/get-by-username', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'user/get-by-email', 'route' => 'rest4matchbook/user/user/get-by-email', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'user/<id:\d+>', 'route' => 'rest4matchbook/user/user/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'user/<id:\d+>', 'route' => 'rest4matchbook/user/user/update', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'user/<id:\d+>', 'route' => 'rest4matchbook/user/user/delete', 'verb' => ['DELETE']],
            ['pattern' => 'user/full/<id:\d+>', 'route' => 'rest4matchbook/user/user/hard-delete', 'verb' => ['DELETE']],
            ['pattern' => 'user/', 'route' => 'rest4matchbook/user/user/create', 'verb' => 'POST'],

            // User: Group Controller
            ['pattern' => 'user/group', 'route' => 'rest4matchbook/user/group/index', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'user/group', 'route' => 'rest4matchbook/user/group/create', 'verb' => 'POST'],
            ['pattern' => 'user/group/<id:\d+>', 'route' => 'rest4matchbook/user/group/view', 'verb' => ['GET']],
            ['pattern' => 'user/group/<id:\d+>', 'route' => 'rest4matchbook/user/group/update', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'user/group/<id:\d+>', 'route' => 'rest4matchbook/user/group/delete', 'verb' => ['DELETE']],
            ['pattern' => 'user/group/<id:\d+>/member', 'route' => 'rest4matchbook/user/group/members', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'user/group/<id:\d+>/member', 'route' => 'rest4matchbook/user/group/member-add', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'user/group/<id:\d+>/member', 'route' => 'rest4matchbook/user/group/member-remove', 'verb' => ['DELETE']],

            // User: Invite Controller
            //['pattern' => 'user/invite', 'route' => 'api/user/invite/index', 'verb' => 'POST'],

            // User: Session Controller
            ['pattern' => 'user/session/all/<id:\d+>', 'route' => 'rest4matchbook/user/session/delete-from-user', 'verb' => 'DELETE'],

            // Space: Default Controller
            ['pattern' => 'space/', 'route' => '/rest4matchbook/space/space/index', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'space/<id:\d+>', 'route' => '/rest4matchbook/space/space/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'space/', 'route' => '/rest4matchbook/space/space/create', 'verb' => 'POST'],
            ['pattern' => 'space/<id:\d+>', 'route' => '/rest4matchbook/space/space/update', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'space/<id:\d+>', 'route' => '/rest4matchbook/space/space/delete', 'verb' => 'DELETE'],

            // Space: Archive Controller
            ['pattern' => 'space/<id:\d+>/archive', 'route' => '/rest4matchbook/space/archive/archive', 'verb' => 'PATCH'],
            ['pattern' => 'space/<id:\d+>/unarchive', 'route' => '/rest4matchbook/space/archive/unarchive', 'verb' => 'PATCH'],

            // Space: Membership Controller
            ['pattern' => 'space/<spaceId:\d+>/membership', 'route' => '/rest4matchbook/space/membership/index', 'verb' => 'GET'],
            ['pattern' => 'space/<spaceId:\d+>/membership/<userId:\d+>', 'route' => '/rest4matchbook/space/membership/create', 'verb' => 'POST'],
            ['pattern' => 'space/<spaceId:\d+>/membership/<userId:\d+>/role', 'route' => '/rest4matchbook/space/membership/role', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'space/<spaceId:\d+>/membership/<userId:\d+>', 'route' => '/rest4matchbook/space/membership/delete', 'verb' => 'DELETE'],

            // Content
            ['pattern' => 'content/find-by-container/<id:\d+>', 'route' => 'rest4matchbook/content/content/find-by-container', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'content/container', 'route' => 'rest4matchbook/content/container/list', 'verb' => 'GET'],
            ['pattern' => 'content/<id:\d+>', 'route' => 'rest4matchbook/content/content/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'content/<id:\d+>', 'route' => 'rest4matchbook/content/content/delete', 'verb' => 'DELETE'],
            //['pattern' => 'content/pin/<id:\d+>', 'route' => 'api/user/content/pin', 'verb' => 'POST'],
            //['pattern' => 'content/unpin/<id:\d+>', 'route' => 'api/user/content/unpin', 'verb' => 'POST'],
            //['pattern' => 'content/archive/<id:\d+>', 'route' => 'api/user/content/archive', 'verb' => 'POST'],
            //['pattern' => 'content/unarchive/<id:\d+>', 'route' => 'api/user/content/unarchive', 'verb' => 'POST'],

            // Comment
            ['pattern' => 'comment', 'route' => 'rest4matchbook/comment/comment/create', 'verb' => 'POST'],
            ['pattern' => 'comment/<id:\d+>', 'route' => 'rest4matchbook/comment/comment/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'comment/<id:\d+>', 'route' => 'rest4matchbook/comment/comment/update', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'comment/<id:\d+>', 'route' => 'rest4matchbook/comment/comment/delete', 'verb' => 'DELETE'],
            ['pattern' => 'comment/find-by-object', 'route' => 'rest4matchbook/comment/comment/find-by-object', 'verb' => 'GET'],
            ['pattern' => 'comment/content/<id:\d+>', 'route' => 'rest4matchbook/comment/comment/find-by-content', 'verb' => 'GET'],

            // Like
            ['pattern' => 'like/<id:\d+>', 'route' => 'rest4matchbook/like/like/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'like/<id:\d+>', 'route' => 'rest4matchbook/like/like/delete', 'verb' => 'DELETE'],
            ['pattern' => 'like/find-by-object', 'route' => 'rest4matchbook/like/like/find-by-object', 'verb' => 'GET'],

            // Post
            ['pattern' => 'post/', 'route' => 'rest4matchbook/post/post/find', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'post/<id:\d+>', 'route' => 'rest4matchbook/post/post/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'post/<id:\d+>', 'route' => 'rest4matchbook/post/post/update', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'post/<id:\d+>', 'route' => 'rest4matchbook/post/post/delete', 'verb' => ['DELETE']],
            ['pattern' => 'post/<id:\d+>/upload-files', 'route' => 'rest4matchbook/post/post/attach-files', 'verb' => 'POST'],
            ['pattern' => 'post/container/<containerId:\d+>', 'route' => 'rest4matchbook/post/post/create', 'verb' => 'POST'],
            ['pattern' => 'post/container/<containerId:\d+>', 'route' => 'rest4matchbook/post/post/find-by-container', 'verb' => 'GET'],

            // Topic
            ['pattern' => 'topic/', 'route' => 'rest4matchbook/topic/topic/index', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'topic/<id:\d+>', 'route' => 'rest4matchbook/topic/topic/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'topic/<id:\d+>', 'route' => 'rest4matchbook/topic/topic/update', 'verb' => ['PUT', 'PATCH']],
            ['pattern' => 'topic/<id:\d+>', 'route' => 'rest4matchbook/topic/topic/delete', 'verb' => ['DELETE']],
            ['pattern' => 'topic/container/<containerId:\d+>', 'route' => 'rest4matchbook/topic/topic/create', 'verb' => 'POST'],
            ['pattern' => 'topic/container/<containerId:\d+>', 'route' => 'rest4matchbook/topic/topic/find-by-container', 'verb' => 'GET'],

            // Activity
            ['pattern' => 'activity/', 'route' => 'rest4matchbook/activity/activity/index', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'activity/<id:\d+>', 'route' => 'rest4matchbook/activity/activity/view', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'activity/container/<containerId:\d+>', 'route' => 'rest4matchbook/activity/activity/find-by-container', 'verb' => ['GET', 'HEAD']],

            // Notification
            ['pattern' => 'notification/', 'route' => 'rest4matchbook/notification/notification/index', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'notification/unseen/', 'route' => 'rest4matchbook/notification/notification/unseen', 'verb' => ['GET', 'HEAD']],
            ['pattern' => 'notification/mark-as-seen/', 'route' => 'rest4matchbook/notification/notification/mark-as-seen', 'verb' => ['PATCH']],
            ['pattern' => 'notification/<id:\d+>', 'route' => 'rest4matchbook/notification/notification/view', 'verb' => ['GET', 'HEAD']],

            // File
            ['pattern' => 'file/download/<id:\d+>', 'route' => 'rest4matchbook/file/file/download', 'verb' => ['GET', 'HEAD']],

        ]);

        Yii::$app->urlManager->addRules([

            // API Config
            ['pattern' => 'rest4matchbook/admin/index', 'route' => 'rest4matchbook/admin', 'verb' => ['POST', 'GET']],

            // Catch all to ensure verbs
            ['pattern' => 'rest4matchbook/<tmpParam:.*>', 'route' => 'rest4matchbook/error/notfound']

        ], true);

        Event::trigger(Module::class, Module::EVENT_REST_API_ADD_RULES);
    }

    private static function addModuleNotFoundRoutes($moduleId)
    {
        /* @var Module $module */
        $module = Yii::$app->getModule('rest4matchbook');
        $module->addRules([
            ['pattern' => $moduleId, 'route' => "rest4matchbook/{$moduleId}/{$moduleId}/not-supported"],
            ['pattern' => "{$moduleId}/<tmpParam:.*>", 'route' => "rest4matchbook/{$moduleId}/{$moduleId}/not-supported"],
        ]);
    }
}
