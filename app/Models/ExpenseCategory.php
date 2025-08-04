<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseCategory extends Model
{
    use Sluggable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'slug', 'note', 'status',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * Get the sub categories.
     */
    public function expSubCategories()
    {
        return $this->hasMany(ExpenseSubCategory::class, 'exp_id');
    }

    /**
     * Get all of the expneses for the category.
     */
    public function catAllExpenses()
    {
        return $this->hasManyThrough(Expense::class, ExpenseSubCategory::class, 'exp_id', 'sub_cat_id');
    }


}
