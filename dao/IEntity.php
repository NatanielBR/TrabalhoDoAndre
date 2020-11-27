<?php


interface IEntity
{
    /**
     * Metodo onde irá retornar uma String e nela
     * @return string
     */
    public static function getTableSQL();
}