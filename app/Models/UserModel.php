<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // --- HASIL PRAKTIKUM 1 (FILLABLE) ---
    protected $fillable = [
        "level_id",
        "username",
        "nama",
        "password"
    ];

    // protected $fillable = [
    //     "level_id",
    //     "username",
    //     "nama"
    // ];

    // --- HASIL PRAKTIKUM 2.7 (RELATIONSHIP) ---
    public function level() : BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
