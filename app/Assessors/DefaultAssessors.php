<?php

namespace App\Assessors;

use Illuminate\Support\Str;


trait DefaultAssessors 
{
    public function getTitleAttribute($value) // padrão de nomeclatura de acessor
    {
        return strtoupper($value);
    }

    public function getBodyAttribute($value)
    {
        return strtoupper($value . ' ' . Str::random(10));
    }

    public function getTitleAndBodyAttribute()
    {
        return $this->title . ' - ' . $this->body . ' Tudo junto e misturado';
    }
}

