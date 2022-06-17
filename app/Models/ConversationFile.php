<?php

namespace App\Models;

use App\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationFile extends Model
{
    use HasFactory;
    protected $table = "conversations_files";

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id');
    }
}
