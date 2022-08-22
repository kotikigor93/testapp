<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 17:53
 */

namespace app\models;

use components\ExpandetModel;

class Users extends ExpandetModel
{
    protected $mainTable = 'users';

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    public function __construct()
    {
        parent::__construct();
        $this->setMainTable($this->mainTable);
    }

    public function init():parent
    {
        parent::init();
        $this->username = $this->data['username'];
        $this->password = $this->data['password'];
        $this->email = $this->data['email'];
        $this->firstname = $this->data['firstname'];
        $this->lastname = $this->data['lastname'];
        return $this;
    }

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username):Users
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername():string
    {
        return $this->username;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password):Users
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email):Users
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * @param $firstname
     * @return $this
     */
    public function setFirstname($firstname):Users
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname():string
    {
        return $this->firstname;
    }

    /**
     * @param $lastname
     * @return $this
     */
    public function setLastname($lastname):Users
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname():string
    {
        return $this->lastname;
    }


    /**
     * @param $username
     * @return array
     */
    public function checkUsername($username):array
    {
        return $this->findTableRowByParams([
            'username' => $username,
        ]);
    }

    /**
     * @param $params
     * @return array
     */
    public function findUserByParams($params):array
    {
        return $this->findTableRowByParams($params);
    }

    /**
     * @return array
     */
    public function findList():array
    {
        return $this->getTableRows();
    }

    /**
     * @return array
     */
    public function save(): array
    {
        if($this->username && $this->password && $this->email && $this->firstname && $this->lastname){
            if($this->checkUsername($this->username)){
                $result = [
                    'result' => false,
                    'text' => 'Логин уже используется!'
                ];
            } else {
                $this->setInsertData([
                    'username' => $this->username,
                    'password' => md5($this->password),
                    'email' => $this->email,
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                ]);

                $result = [
                    'result' => true,
                    'text' => 'Успешная регистрация!',
                    'user_id' => $this->insertTableRow()
                ];
            }
        } else {
            $result = [
                'result' => false,
                'text' => 'Упс! Что-то пошло не так!'
            ];
        }
        return $result;
    }
}