<?php

return [

    'Dashboard' => [
        'role'   => 'redac',
        'route'  => 'admin',
        'icon'   => 'tachometer-alt',
    ],
    'Users' => [
        'icon' => 'user',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All users',
                'role'  => 'admin',
                'route' => 'users.index',
            ],
            [
                'name'  => 'New users',
                'role'  => 'admin',
                'route' => 'users.indexnew',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'users.edit',
            ],
        ],
    ],
    'Fournisseurs' => [
        'icon' => 'user',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Tout Fournisseurs',
                'role'  => 'admin',
                'route' => 'fournisseurs.index',
            ],
            [
                'name'  => 'Nouveau Fournisseur',
                'role'  => 'admin',
                'route' => 'fournisseurs.indexnew',
            ],
            [
                'name'  => 'Ajouter',
                'role'  => 'admin',
                'route' => 'fournisseurs.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'fournisseurs.edit',
            ],
        ],
    ],
    'Categories' => [
        'icon' => 'list',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'All categories',
                'role'  => 'admin',
                'route' => 'categories.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'admin',
                'route' => 'categories.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'categories.edit',
            ],
        ],
    ], 
    'Produits' => [
        'icon' => 'file-alt',
        'role'   => 'redac',
        'children' => [
            [
                'name'  => 'Tous les produits',
                'role'  => 'redac',
                'route' => 'products.index',
            ],
            [
                'name'  => 'Nouveau produits',
                'role'  => 'admin',
                'route' => 'products.indexnew',
            ],
            [
                'name'  => 'Produits Disponibles',
                'role'  => 'admin',
                'route' => 'products.index',
            ],
            [
                'name'  => 'Produits Périmés',
                'role'  => 'admin',
                'route' => 'products.index',
            ],
            [
                'name'  => 'Mouvement de stock',
                'role'  => 'admin',
                'route' => 'products.index',
            ],
            [
                'name'  => 'Add',
                'role'  => 'redac',
                'route' => 'products.create',
            ],
            [
                'name'  => 'fake',
                'role'  => 'redac',
                'route' => 'products.edit',
            ],
        ],
    ],
    'Commandes' => [
        'icon' => 'shopping-cart',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Passé une Commande',
                'role'  => 'admin',
                'route' => 'cartcmd.index',
            ],  
            [
                'name'  => 'Toutes les commandes',
                'role'  => 'admin',
                'route' => 'commandes.index',
            ],
            [
                'name'  => 'Livraison des produits',
                'role'  => 'admin',
                'route' => 'produits.livrer',
            ],   
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'cartcmd.index',
            ],
        ],
    ],
    'Ventes' => [
        'icon' => 'shopping-cart',
        'role'   => 'admin',
        'children' => [
            [
                'name'  => 'Passé une vente',
                'role'  => 'admin',
                'route' => 'cartvente.index',
            ],
            [
                'name'  => 'Recettes',
                'role'  => 'admin',
                'route' => 'ventes.index',
            ],  
           
            [
                'name'  => 'fake',
                'role'  => 'admin',
                'route' => 'cartvente.index',
            ],
        ],
    ],
];