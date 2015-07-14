<?php
namespace app\commands;

use yii\helpers\Console;
use yii\console\Controller;
use Yii;

/**
 * Creates base rbac authorization data for our application.
 * -----------------------------------------------------------------------------
 * Creates 3 roles:
 *
 * - guest      : can visit site as guest
 * - admin      : administrators of this site
 * - editor     : editor of this site
 *
 * Creates 5 permissions:
 *
 * - createPost         : allows editor roles to create posts
 * - updatePost         : allows editor roles to update all posts
 * - deletePost         : allows admin  roles to delete posts
 * - adminPost          : allows admin  roles to manage posts
 * - manageUsers        : allows admin  roles to manage users (CRUD plus role assignment)
 *
 */
class RbacController extends Controller
{
    /**
     * Initializes the RBAC authorization data.
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //---------- PERMISSIONS ----------//

        // add "manageUsers" permission
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Allows admin roles to manage users';
        $auth->add($manageUsers);

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Allows editor roles to create posts';
        $auth->add($createPost);

        // add "deletePost" permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Allows admin roles to delete posts';
        $auth->add($deletePost);

        // add "adminPost" permission
        $adminPost = $auth->createPermission('adminPost');
        $adminPost->description = 'Allows admin roles to manage posts';
        $auth->add($adminPost);  

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Allows editor roles to update posts';
        $auth->add($updatePost);

        //---------- ROLES ----------//

        // add "guest" role
        $guest = $auth->createRole('guest');
        $guest->description = 'can visit the site as guest user';
        $auth->add($guest);

        // add "editor" role and give this role: 
        // createPost and updatePost permissions, plus he can do everything that guest role can do.
        $editor = $auth->createRole('editor');
        $editor->description = 'Editor of this application';
        $auth->add($editor);
        $auth->addChild($editor, $guest);
        $auth->addChild($editor, $createPost);
        $auth->addChild($editor, $updatePost);
        

        // add "admin" role and give this role: 
        // manageUsers, adminPost and deletePost permissions, plus he can do everything that editor role can do.
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator of this application';
        $auth->add($admin);
        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($editor, $adminPost);
        $auth->addChild($admin, $deletePost);

        if ($auth) 
        {
            $this->stdout("\nRbac authorization data are installed successfully.\n", Console::FG_GREEN);
        }
    }
}