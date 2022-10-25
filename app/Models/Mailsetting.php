<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailsetting extends Model
{
 /**
 * The table associated with the model.
 *
 * @var string
 */ 

protected $table = 'mailsettings';

    use HasFactory;

    protected $guarded = [];

}
