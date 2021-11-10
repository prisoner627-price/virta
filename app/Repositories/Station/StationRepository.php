<?php

namespace App\Repositories\Station;

use App\Models\Station;
use App\Specifications\Pagination;
use App\Repositories\BaseRepository;
use App\Specifications\Specification;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StationRepository extends BaseRepository
{
    protected array $fillable = ['name', 'company_id', 'address'];

    protected function model(): string
    {
        return Station::class;
    }

    public function create(array $data, array $fillable = []): Model
    {
        $object = $this->fill($data, $this->makeModel(), $fillable);
        $object->location = new Point($data['lat'], $data['long']);
        $object->save();

        return $object;
    }

    public function update(array $data, $object, array $fillable = []): Model
    {
        if (!($object instanceof Model)) {
            $object = $this->find($object);
        }

        $object = $this->fill($data, $object, $fillable);
        $object->location = new Point(
            $data['lat'] ?? $object->location->getLat(),
            $data['long'] ?? $object->location->getLng()
        );
        $object->save();

        return $object;
    }

    public function paginateMatchingSpecification(
        Specification $specification,
        Pagination $pagination
    ): LengthAwarePaginator {
        return $specification->toQuery(Station::query())
            ->with(['company'])
            ->orderBy('id', 'desc')
            ->paginate($pagination->getPerPage(), ['*'], 'page', $pagination->getPage());
    }
}
