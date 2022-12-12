<?php

namespace App\Models;

use App\Assessors\DefaultAssessors;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Post extends Model
{
    use HasFactory, DefaultAssessors;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'date'
    ];

    protected $casts = ['date' => 'datetime:d/m/Y'];

    // public function getTitleAttribute($value) // padrão de nomeclatura de acessor
    // {
    //     return strtoupper($value);
    // }

    // public function getBodyAttribute($value)
    // {
    //     return strtoupper($value . ' ' . Str::random(10));
    // }

    // public function getTitleAndBodyAttribute()
    // {
    //     return $this->title . ' - ' . $this->body . ' Tudo junto e misturado';
    // }

    public function setDateAttribute($value)
    {
        return $this->attributes['date'] = Carbon::make($value)->format('y-m-d');
    }
}
