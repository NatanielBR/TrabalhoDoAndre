<?php


interface IReporsitory
{
    public function findAll();
    public function findById($id);
    public function delete($entity);
    public function saveOrUpdate($entity);
    public function exists($id);
}