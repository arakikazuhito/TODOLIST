<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'tasks';

    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger'],
        2 => [ 'label' => '着手中', 'class' => 'label-info'],
        3 => [ 'label' => '完了',   'class' => ''],
    ];

    public function getStatusLabelAttribute()
    {
        //状態値
        $status = $this->attributes['status'];

        //定義されていなければ空文字を返す
        if(!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }
        
        return self::STATUS[$status]['class'];

    }


    /**
     * 整形した日付
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d',$this->attributes['due_date'])->format('Y/m/d');
    }
}

class Person extends Model
{
    public function getGenderTextAttribute()
    {
        switch($this->attributes['gender']) {
            case 1:
                return 'male';
            case 2;
                return 'female';
            default:
                return '??';
        }
    }
}