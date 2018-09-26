<?php

namespace App\Models\Common;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Model;

class VacancyCategory extends Model
{
    use Scopes;

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    protected $guarded = ['id'];

    public function vacancies(){
        return $this->belongsToMany(Vacancy::class);
    }
}
