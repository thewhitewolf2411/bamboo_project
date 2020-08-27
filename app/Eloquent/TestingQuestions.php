<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TestingQuestions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testing_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','question','answer_1','answer_2'
    ];
}
