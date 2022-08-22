<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 19:42
 */

namespace components;

use app\models\Users;
use components\enums\UserRolesTypeEnum;

class SRC
{
    /**
     * @param string $filename
     * @param array $data
     */
    public static function template(string $filename = 'error', array $data = [])
    {
        file_exists(ROOT . '/view/content' . ucfirst($filename) . '.php') ? require_once ROOT . '/view/content' . ucfirst($filename) . '.php' : require_once ROOT . '/view/contentIndex.php';
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isNumeric($value): bool
    {
        return is_numeric($value);
    }

    public static function isAdmin($userId): bool
    {
        $user = new Users();
        $userData = $user->setId($_SESSION['user_id'])->init()->getData();
        return $userData[0]['role'] == UserRolesTypeEnum::ADMIN;
    }

    public static function redirect($url = '')
    {
        if(!$url){
            $src = $_SERVER['HTTP_REFERER'];
        }
        header('Location: ' . $url);
    }

    /**
     * @return string
     */
    public static function getURI():string
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $temp_url = stristr($url, '?', true);
            foreach ($_REQUEST as $key=>$item){
                $_POST[$key]= $item;
            }
            if($temp_url!==false){
                return $temp_url;
            }
        } else {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * @param array $data
     * @param string $groupColumnTitle
     * @return array
     */
    public static function groupArrayByColumn(
        array  $data,
        string $groupColumnTitle = 'id'
    ): array
    {
        $result = [];
        foreach ($data as $id => $row) {
            if (array_key_exists($groupColumnTitle, $row)) {
                $result[$row[$groupColumnTitle]] = $row;
            }
        }
        return $result;
    }

    /**
     * @param array $data
     * @param string $groupColumnTitle
     * @return array
     */
    public static function groupArrayByColumnKeepSorting(
        array  $data,
        string $groupColumnTitle = 'id'
    ): array
    {
        $result = [];
        foreach ($data as $id => $row) {
            if (array_key_exists($groupColumnTitle, $row)) {
                $result[$row[$groupColumnTitle]][$id] = $row;
            }
        }
        foreach ($result as &$sortedByKeys) {
            ksort($sortedByKeys);
            $sortedByKeys = array_values($sortedByKeys);
        }
        return $result;
    }
}