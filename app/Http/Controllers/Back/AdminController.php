<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

class AdminController extends CommonController
{
    protected $data = [
        [
            'name' => '首页',
            'route' => '/',
        ],
        [
            'name' => '用户',
            'route' => 'user.index',
            'child' => [
                [
                    'name' => '添加用户',
                    'route' => 'user.create',
                ],
                [
                    'name' => '编辑用户',
                    'route' => 'user.edit',
                ],
                [
                    'name' => '删除用户',
                    'route' => 'user.destroy',
                ],
                [
                    'name' => '授权用户组',
                    'route' => 'user.authorizationGroup',
                ],
                [
                    'name' => '授权角色',
                    'route' => 'user.authorizationRole',
                ]
            ]

        ],
        [
            'name' => '用户组',
            'route' => 'group.index',
            'child' => [
                [
                    'name' => '添加用户组',
                    'route' => 'group.create',
                ],
                [
                    'name' => '编辑用户组',
                    'route' => 'group.edit',
                ],
                [
                    'name' => '删除用户组',
                    'route' => 'group.destroy'
                ],
                [
                    'name' => '授权角色',
                    'route' => 'group.authorizationRole',
                ]
            ]

        ],
        [
            'name' => '角色',
            'route' => 'role.index',
            'child' => [
                [
                    'name' => '添加角色',
                    'route' => 'role.add',
                ],
                [
                    'name' => '编辑角色',
                    'route' => 'role.edit',
                ],
                [
                    'name' => '删除角色',
                    'route' => 'role.destroy',
                ],
                [
                    'name' => '访问授权',
                    'route' => 'access.index'
                ]
            ]
        ],
        [
            'name' => '文章',
            'route' => 'articles.index',
            'child' => [
                [
                    'name' => '添加文章',
                    'route' => 'articles.create',
                ],
                [
                    'name' => '编辑文章',
                    'route' => 'articles.edit',
                ],
                [
                    'name' => '删除文章',
                    'route' => 'articles.destroy',
                ]
            ],
        ],
        [
            'name' => '文章分类',
            'route' => 'articleCategory.index',
            'child' => [
                [
                    'name' => '添加文章分类',
                    'route' => 'articleCategory.create',
                ],
                [
                    'name' => '编辑文章分类',
                    'route' => 'articleCategory.edit',
                ],
                [
                    'name' => '删除文章分类',
                    'route' => 'articleCategory.destroy',
                ]
            ]
        ],
        [
            'name' => '菜单',
            'route' => 'menu.index',
            'child' => [
                [
                    'name' => '添加菜单',
                    'route' => 'menu.create',
                ],
                [
                    'name' => '编辑菜单',
                    'route' => 'menu.edit',
                ],
                [
                    'name' => '删除菜单',
                    'route' => 'menu.destroy',
                ],
            ],
        ]
    ];

    public function index()
    {
        recursionMenu($this->data);die();
        return view('Back.Index.index');
    }

}
