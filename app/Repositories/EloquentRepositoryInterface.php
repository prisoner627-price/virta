<?php

namespace App\Repositories;

use App\Specifications\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EloquentRepositoryInterface
{
    public function all($columns = ['*']): Collection;
    public function paginate($perPage = Setting::PAGE_SIZE, $columns = ['*']): LengthAwarePaginator;
    public function create(array $data): Model;
    public function update(array $data, $id): Model;
    public function delete($id): bool;
    public function find(int $id, $columns = ['*']);
    public function findBy($field, $value, $columns = ['*']): Model;
}
