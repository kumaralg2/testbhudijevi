<?php

namespace App\Models;
use Eloquent;

use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class Fbuser extends Eloquent
{
    use SyncableGraphNodeTrait;

    protected $table = 'tblusermaster';
    
    protected static $graph_node_field_aliases = [
        'id_fb_user' => 'id',
        'tUsrFName' => 'first_name',
        'tUsrLName' => 'last_name'
    ];


}