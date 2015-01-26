<?php
/**
 * @link http://www.github.com/davidsonalencar/yii2-basic
 * @copyright Copyright (c) 2014 Davidson Alencar
 * @license https://github.com/davidsonalencar/yii2-basic/blob/master/LICENCE.md
 */

namespace app\modules\main\widgets;

use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\main\forms\SearchForm;
use Yii;

/**
 * SearchNavbar renderiza navbar search form.
 *
 * Por exemplo,
 *
 * ```php
 * $nav = Nav::begin();
 *            
 * $nav->items[] = SearchNavbar::widget();
 *
 * Nav::end();
 * ```
 * @see http://getbootstrap.com/components/#navbar-forms
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 201401.1
 */
class NavNotification extends Widget {
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        parent::run();

        echo '
        <a class="dropdown-toggle menu-icon dropdown-hover" data-toggle="dropdown" href="javascript:;">
            <i class="fa fa-fw fa-exclamation-circle"></i>
            <span class="badge badge-primary"> 11</span>
        </a>
        <ul class="dropdown-menu notifications">
            <li>
                <span class="dropdown-menu-title"> You have 11 notifications</span>
            </li>
            <li>
                <div class="drop-down-wrapper ps-container ps-active-y">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                <span class="message"> New user registration</span>
                                <span class="time"> 1 min</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                <span class="message"> New comment</span>
                                <span class="time"> 7 min</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                <span class="message"> New comment</span>
                                <span class="time"> 8 min</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                <span class="message"> New comment</span>
                                <span class="time"> 16 min</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                <span class="message"> New user registration</span>
                                <span class="time"> 36 min</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-warning"><i class="fa fa-shopping-cart"></i></span>
                                <span class="message"> 2 items sold</span>
                                <span class="time"> 1 hour</span>
                            </a>
                        </li>
                        <li class="warning">
                            <a href="javascript:void(0)">
                                <span class="label label-danger"><i class="fa fa-user"></i></span>
                                <span class="message"> User deleted account</span>
                                <span class="time"> 2 hour</span>
                            </a>
                        </li>
                        <li class="warning">
                            <a href="javascript:void(0)">
                                <span class="label label-danger"><i class="fa fa-shopping-cart"></i></span>
                                <span class="message"> Transaction was canceled</span>
                                <span class="time"> 6 hour</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                <span class="message"> New comment</span>
                                <span class="time"> yesterday</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                <span class="message"> New user registration</span>
                                <span class="time"> yesterday</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-primary"><i class="fa fa-user"></i></span>
                                <span class="message"> New user registration</span>
                                <span class="time"> yesterday</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                <span class="message"> New comment</span>
                                <span class="time"> yesterday</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <span class="label label-success"><i class="fa fa-comment"></i></span>
                                <span class="message"> New comment</span>
                                <span class="time"> yesterday</span>
                            </a>
                        </li>
                    </ul>
                    <div class="ps-scrollbar-x-rail" style="width: 270px; display: none; left: 0px; bottom: 3px;">
                        <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0px; height: 250px; display: inherit; right: 3px;">
                        <div class="ps-scrollbar-y" style="top: 0px; height: 149px;"></div>
                    </div>
                </div>
            </li>
            <li class="view-all">
                <a href="javascript:void(0)">
                    See all notifications <i class="fa fa-arrow-circle-o-right"></i>
                </a>
            </li>
        </ul>';
 
    }
    
}