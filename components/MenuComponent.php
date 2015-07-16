<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class MenuComponent extends Component
{
    public function getMenuItems() {
        
        // everyone can see Home page
        $menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/']];

        // display Post admin page to editor+ roles
        if (Yii::$app->user->can('editor')) {
            $menuItems[] = ['label' => Yii::t('app', 'Posts'), 'url' => ['/post/admin']];
        }

        // display Users to admin+ roles
        if (Yii::$app->user->can('admin')) {
            $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
            $menuItems[] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['/gallery/admin']];
            $menuItems[] = ['label' => Yii::t('app', 'Testimonials'), 'url' => ['/testimonials/admin']];
        }

        // display Signup and Login pages to guests of the site
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => Yii::t('app', 'Tours'), 'url' => ['/tours']];
            $menuItems[] = ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog']];
            $menuItems[] = ['label' => Yii::t('app', 'Contact Us'), 'url' => ['/contact']];
        }

        return $menuItems;
    }

}

