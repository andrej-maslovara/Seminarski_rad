<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    protected $table = 'navigation';

    protected $fillable = ['title', 'url'];

    public static function navigationItems()
    {
        return [
            [
                'title' => 'Regulate Users roles',
                'url' => '/assign-role',
            ],
            [
                'title' => 'Regulate Roles',
                'url' => '/roles',
            ],
            [
                'title' => 'Page manager',
                'url' => '/manager',
            ],
            [
                'title' => 'Navigation manager',
                'url' => '/navigation',
            ],
            [
                'title' => 'Show all Users',
                'url' => '/user-list',
            ],
            [
                'title' => 'Show All Posts',
                'url' => '/all-posts',
            ],
            [
                'title' => 'Show my Posts',
                'url' => '/my-posts',
            ],
            [
                'title' => 'Create a Post',
                'url' => '/create-post',
            ],
            [
                'title' => 'Create a new page',
                'url' => '/create-page',
            ],
            [
                'title' => '< Go Back',
                'url' => '/',
            ],
        ];
    }
}
