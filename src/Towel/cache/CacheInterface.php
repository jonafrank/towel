<?php
/**
 * Created by PhpStorm.
 * User: ezequiel
 * Date: 5/26/14
 * Time: 5:29 PM
 */

namespace Towel\cache;


interface CacheInterface {
    public function get($key);
    public function set($key, $value, $expire = null);
    public function clear();
    public function delete($key);
    public function setOptions($options);
}