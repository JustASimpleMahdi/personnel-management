<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

trait DateFilterTrait
{
    public function dateFilters(Request $request, Model $model)
    {
        $dateFilters = collect($request->query())->only(['from', 'to'])->reject(function ($value) {
            return !preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $value);
        });
        $query = $model::where(function ($query) use ($dateFilters) {
            if ($dateFilters->has('from')) {
                $datetime = Jalalian::fromFormat('Y/m/d', $dateFilters['from'])->toCarbon()->toDateTimeString();
                $query->where('updated_at', '>=', $datetime);
            }
            if ($dateFilters->has('to')) {
                $datetime = Jalalian::fromFormat('Y/m/d', $dateFilters['to'])->addDay()->toCarbon()->toDateTimeString();
                $query->where('updated_at', '<', $datetime);
            }
        });
        return $query;
    }
}
