<?php
namespace app\rbac\helpers;

use app\models\User;
use app\rbac\models\Role;
use Yii;

/**
 * Rbac helper class.
 */
class RbacHelper
{
    /**
     * Assigns the appropriate role to the registered user.
     * If this is the first registered user in our system, he will get the
     * Admin role (this should be you), if not, he will get the member role.
     *
     * @param  integer $id The id of the registered user.
     * @return string      Role name.
     */
    public static function assignRole($id)
    {
        // make sure there are no leftovers
        Role::deleteAll(['user_id' => $id]);

        $usersCount = User::find()->count();

        $auth = Yii::$app->authManager;

        // this is the first user in our system, give him admin role
        if ($usersCount == 1)
        {
            $role = $auth->getRole('admin');
            $auth->assign($role, $id);
        } 
        else 
        {
            $role = $auth->getRole('guest');
            $auth->assign($role, $id);
        }

        // return assigned role name in case you want to use this method in tests
        return $role->name;
    }
}

