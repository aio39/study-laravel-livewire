<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

//    whitelist 방법으로 create에서 사용 가능 컬럼 지정
    protected $fillable = [
        "contnet","image","user_id"
    ];

//    protected $guard = [
//        "blackListColumn"
//    ]

    public function writer() {
        // 함수 이름이 user라면 자동으로 fk를 user_id로 해서 조인하지만, 같지 않다면 수동으로 설정
        return $this->belongsTo(User::class,'user_id');
    }
}
