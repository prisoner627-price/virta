<?php

namespace App\Repositories;

use Exception;
use App\Specifications\Setting;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements EloquentRepositoryInterface
{
    protected array $fillable = [];

    public function __construct(private Container $container)
    {
    }

    abstract protected function model(): string;

    public function all($columns = ['*']): Collection
    {
        return $this->query()->get($columns);
    }

    public function paginate($perPage = Setting::PAGE_SIZE, $columns = ['*']): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage, $columns);
    }

    public function create(array $data, array $fillable = []): Model
    {
        $object = $this->fill($data, $this->makeModel(), $fillable);
        $object->save();

        return $object;
    }

    public function update(array $data, $object, array $fillable = []): Model
    {
        if (!($object instanceof Model)) {
            $object = $this->find($object);
        }

        $object = $this->fill($data, $object, $fillable);
        $object->save();

        return $object;
    }

    public function delete($object): bool
    {
        if (is_numeric($object)) {
            $object = $this->find($object)->first();
        }

        return $object->delete();
    }

    public function find(int $id, $columns = ['*'])
    {
        return $this->query()->find($id, $columns);
    }

    public function findBy($attribute, $value, $columns = ['*']): Model
    {
        return $this->query()
            ->where($attribute, '=', $value)
            ->first($columns);
    }

    public function query(): Builder
    {
        return $this->makeModel()->newQuery();
    }

    public function makeModel(): Model
    {
        $model = $this->container->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model",
            );
        }

        return $model;
    }

    public function fill(array $data, $object, array $fillable = []): Model
    {
        if (empty($fillable)) {
            $fillable = $this->fillable;
        }

        if (!empty($fillable)) {
            $object->fillable($fillable)->fill($data);
        }

        return $object;
    }
}
