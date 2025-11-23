<?php

namespace App\Infrastructure\Billet\Persistence\Eloquent;

use App\Domain\Billet\Repositories\BilletRepository;
use App\Models\Billet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BilletEloquentRepository implements BilletRepository
{
    public function __construct(
        private Billet $model
    ) {}


    public function paginateWithFilters(?string $search, int $page, int $perPage, string $orderBy, string $direction): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('payer_name', 'like', "%{$search}%")
                  ->orWhere('payer_document', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('recipient_document', 'like', "%{$search}%")
                  ->orWhere('amount', 'like', "%{$search}%");
            });
        }

        return $query->orderBy($orderBy, $direction)
                     ->paginate($perPage, ['*'], 'page', $page);
    }

    public function findById(int $id): ?Billet
    {
        return $this->model->find($id);
    }

    public function create(array $data): Billet
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Billet
    {
        $billet = $this->model->findOrFail($id);

        $billet->update($data);

        return $billet;
    }

    public function delete(int $id): void
    {
        $this->model->whereKey($id)->delete();
    }
}
