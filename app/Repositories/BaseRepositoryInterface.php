<?php

namespace App\Repositories;

interface BaseRepositoryInterface {
    public function all(int $itemPerPage, $column = ['*']);
    public function find($id, $column = ['*']);
    public function create(array $data);
    public function update($id, array $data, $attribute = "id");
    public function delete($id);
}

