<?php

namespace Services;

use Services\Base;

/**
 * Worker操作类
 *
 * @package   Worker
 * @author    yangjian
 * @date      2021-07-15
 * @copyright 中教智网
 * @license   http://www.eol.cn
 * @link      http://www.eol.cn
 * @since     Version 2.0
 */
class Student {
    // /**
    //  * 考生状态恢复
    //  *
    //  * @author yangjian
    //  * @date   2021-07-15
    //  * @param [type] $ws_worker
    //  * @param [type] $connection
    //  * @return void
    //  */
    // public static function init(&$ws_worker, $connection) {
    //     if ($ws_worker->room[$connection->user_id][$connection->user_id]['step'] == 2) {
    //         $connection->send(Base::success("cStart", "开始面试"));
    //     }
    // }

    // /**
    //  * 发送学生等待页状态(单播/广播)
    //  *
    //  * @author lizg
    //  * @date   2021-07-15
    //  * @return void
    //  */
    // public static function s_get_status(&$ws_worker, $db, $connection, $data) {

    // }

    /**
     * 发送邀请学生面试通知
     *
     * @author lizg
     * @date   2021-07-15
     * @return void
     */
    public static function wsSendInvite() {

    }

    /**
     * 学生确认进入面试
     *
     * @author lizg
     * @date   2021-07-15
     * @return void
     */
    public static function wsIntoFace() {

    }

    /**
     * 发送学生面试结束通知
     *
     * @author lizg
     * @date   2021-07-15
     * @return void
     */
    public static function s_set_end(&$ws_worker, $db, $connection, $data) {

    }
}