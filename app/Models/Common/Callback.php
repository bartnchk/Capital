<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $fillable = ['phone', 'status', 'name'];

    public function toggle()
    {
        $this->status = !$this->status;
        return $this;
    }
}
