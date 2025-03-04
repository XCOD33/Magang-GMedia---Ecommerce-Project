<?php

namespace App\Services;

class ViewService
{
    private $menuMap = [
        'user' => [
            'title' => 'User',
            'create_route' => 'dashboard.data-master.user.create'
        ],
        'store' => [
            'title' => 'Store',
        ],
        'product-category' => [
            'title' => 'Product Category',
            'create_route' => 'dashboard.data-master.product-category.create'
        ],
        'voucher' => [
            'title' => 'Voucher',
            'create_route' => 'dashboard.data-master.voucher.create'
        ]
    ];

    public function getPageInfo($path)
    {
        $segments = explode('/', $path);
        $lastSegment = end($segments);

        $data = [
            'title' => 'Dashboard',
            'create_route' => null
        ];

        // Cek apakah segment terakhir ada di menuMap
        if (isset($this->menuMap[$lastSegment])) {
            $menu = $this->menuMap[$lastSegment];
            $data['title'] = $menu['title'];
            $data['create_route'] = isset($menu['create_route']) ? route($menu['create_route']) : null;
        }

        // Handle create/edit pages
        if (str_contains($path, 'create')) {
            $menuKey = $segments[count($segments) - 2];
            $data['title'] = 'Tambah ' . ($this->menuMap[$menuKey]['title'] ?? ucfirst($menuKey));
        } else if (str_contains($path, 'edit')) {
            $menuKey = $segments[count($segments) - 3];
            $data['title'] = 'Edit ' . ($this->menuMap[$menuKey]['title'] ?? ucfirst($menuKey));
        }

        return $data;
    }
}
