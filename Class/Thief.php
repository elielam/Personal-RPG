<?php
/**
 * Created by PhpStorm.
 * User: c03735
 * Date: 08/01/2018
 * Time: 14:45
 */

class Thief extends Personnage
{

    private $_life;
    private $_degat;
    private $_armor;
    private $_agi;
    private $_str;
    private $_dex;
    private $_luck;

    public function __construct(array $donnees)
    {
        parent::__construct($donnees);
        $this->_life = 50;
        $this->_degat = 200;
        $this->_armor = 50;
        $this->_agi = 0;
        $this->_str = 0;
        $this->_dex = 0;
        $this->_luck = 62;
    }

    /**
     * @return int
     */
    public function getLife()
    {
        return $this->_life;
    }

    /**
     * @param int $life
     */
    public function setLife($life)
    {
        $this->_life = $life;
    }

    /**
     * @return int
     */
    public function getDegat()
    {
        return $this->_degat;
    }

    /**
     * @param int $degat
     */
    public function setDegat($degat)
    {
        $this->_degat = $degat;
    }

    /**
     * @return int
     */
    public function getArmor()
    {
        return $this->_armor;
    }

    /**
     * @param int $armor
     */
    public function setArmor($armor)
    {
        $this->_armor = $armor;
    }

    /**
     * @return mixed
     */
    public function getAgi()
    {
        return $this->_agi;
    }

    /**
     * @param mixed $agi
     */
    public function setAgi($agi)
    {
        $this->_agi = $agi;
    }

    /**
     * @return mixed
     */
    public function getStr()
    {
        return $this->_str;
    }

    /**
     * @param mixed $str
     */
    public function setStr($str)
    {
        $this->_str = $str;
    }

    /**
     * @return mixed
     */
    public function getDex()
    {
        return $this->_dex;
    }

    /**
     * @param mixed $dex
     */
    public function setDex($dex)
    {
        $this->_dex = $dex;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->_luck;
    }

    /**
     * @param mixed $luck
     */
    public function setLuck($luck)
    {
        $this->_luck = $luck;
    }

}