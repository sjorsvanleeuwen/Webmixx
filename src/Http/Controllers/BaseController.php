<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function incrementSubElementOrder(HasMany $relation, string $parent_element, ?int $parent_element_id, int $from_order, ?int $to_order = null, ?int $exclude_id = null): void
    {
        $query = $relation->getQuery()
            ->where($parent_element, $parent_element_id)
            ->where('order', '>=', $from_order);

        if ($to_order !== null) {
            $query->where('order', '<', $to_order);
        }

        if ($exclude_id !== null) {
            $query->where('id', '!=', $exclude_id);
        }

        $query->increment('order');
    }

    protected function decrementSubElementOrder(HasMany $relation, string $parent_element, ?int $parent_element_id, int $from_order, ?int $to_order = null, ?int $exclude_id = null): void
    {
        $query = $relation->getQuery()
            ->where($parent_element, $parent_element_id)
            ->where('order', '>', $from_order);

        if ($to_order !== null) {
            $query->where('order', '<=', $to_order);
        }

        if ($exclude_id !== null) {
            $query->where('id', '!=', $exclude_id);
        }

        $query->decrement('order');
    }
}
