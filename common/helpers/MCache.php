<?php
/**
 * 缓存类, 统一管理缓存
 * 功能 : 统一管理系统缓存, 分配缓存KEY
 *
 * @author tasal<fei.he@pcstars.com>
 * @version $Id: MCache.php 36866 2017-02-27 09:53:33Z A1165 $
 */

namespace common\helpers;

use Yii;

class MCache{

    const KEY_HYPEHN = ':';

    public static function get($key)
    {
        return Yii::$app->cache->get($key);
    }

    public static function set($key,$value,$timeout=0)
    {
        return Yii::$app->cache->set($key,$value,$timeout);
    }
    
    public static function delete($key){
        return Yii::$app->cache->delete($key);
    }
}


