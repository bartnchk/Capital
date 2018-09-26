<?php

namespace App\Search;
use App\Models\Admin\Action;
use App\Models\Admin\News;
use Illuminate\Database\Eloquent\Collection;

class DatabaseRepository implements SearchRepository
{
    public function search(string $search = "")
    {
       $news =  News::where(function ($query) use ($search) {
            return $this->getConditions($query, $search);
        })
            ->get(['id', 'title_ru', 'title_uk', 'description_ru', 'description_uk', 'type', 'alias']);

        $actions =  Action::where(function ($query) use ($search) {
            return $this->getConditions($query, $search);
        })
            ->get(['id', 'title_ru', 'title_uk', 'description_ru', 'description_uk', 'type', 'alias']);

        $all = new Collection;
        $all = $all->merge($news)->merge($actions);
        return $all = $all->merge($news)->merge($actions);

    }

    public function getConditions($query, $search)
    {
        return $query->where('title_ru', 'like', "%{$search}%")
            ->orWhere('description_ru', 'like', "%{$search}%")
            ->orWhere('title_uk', 'like', "%{$search}%")
            ->orWhere('description_uk', 'like', "%{$search}%");
    }
}