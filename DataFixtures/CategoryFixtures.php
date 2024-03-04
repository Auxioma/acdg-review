<?php

    include '../Config/Database.php';
    include '../vendor/autoload.php';

    // je vais recupéré mes utilisateurs
    $users = 'SELECT id FROM user';
    $stmt = $conn->prepare($users);
    $stmt->execute();
    $user = $stmt->fetchAll();

    $category = [
        1 => [
            'slug' => 'musique',
            'CreatedAt' => '2021-01-01 00:00:00',
            'UpdatedAt' => '2021-01-01 00:00:00',
            'slider' => '["1.jpg"]',
            'title' => 'Musique',
            'seoTitle' => 'Tous les articles sur la musique',
            'seoDescription' => 'Retrouvez tous les articles sur la musique',
        ],
        2 => [
            'slug' => 'cinema',
            'CreatedAt' => '2021-01-01 00:00:00',
            'UpdatedAt' => '2021-01-01 00:00:00',
            'slider' => '["1.jpg"]',
            'title' => 'Cinéma',
            'seoTitle' => 'Tous les articles sur le cinéma',
            'seoDescription' => 'Retrouvez tous les articles sur le cinéma',
        ],
        3 => [
            'slug' => 'category-3',
            'CreatedAt' => '2021-01-01 00:00:00',
            'UpdatedAt' => '2021-01-01 00:00:00',
            'slider' => '["1.jpg"]',
            'title' => 'Category 3',
            'seoTitle' => 'Category 3',
            'seoDescription' => 'Category 3',
        ],
        4 => [
            'slug' => 'category-4',
            'CreatedAt' => '2021-01-01 00:00:00',
            'UpdatedAt' => '2021-01-01 00:00:00',
            'slider' => '["1.jpg"]',
            'title' => 'Category 4',
            'seoTitle' => 'Category 4',
            'seoDescription' => 'Category 4',
        ],
        5 => [
            'slug' => 'category-5',
            'CreatedAt' => '2021-01-01 00:00:00',
            'UpdatedAt' => '2021-01-01 00:00:00',
            'slider' => '["1.jpg"]',
            'title' => 'Category 5',
            'seoTitle' => 'Category 5',
            'seoDescription' => 'Category 5',
        ],
        6 => [
            'slug' => 'category-6',
            'CreatedAt' => '2021-01-01 00:00:00',
            'UpdatedAt' => '2021-01-01 00:00:00',
            'slider' => '["1.jpg"]',
            'title' => 'Category 6',
            'seoTitle' => 'Category 6',
            'seoDescription' => 'Category 6',
        ],
    ];

    foreach ($category as $key => $value) {
        $sql = "INSERT INTO categories (`slug`, `created_at`, `updated_at`, `slider`, `title`, `sio_title`,`meta_description`,`user_id`) VALUES (:slug, :created_at, :updated_at, :slider, :title, :sio_title, :meta_description, :user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'slug' => $value['slug'],
            'created_at' => $value['CreatedAt'],
            'updated_at' => $value['UpdatedAt'],
            'slider' => $value['slider'], // attention en JSON
            'title' => $value['title'],
            'sio_title' => $value['seoTitle'],
            'meta_description' => $value['seoDescription'],
            'user_id' => $user[0]['id']
        ]);

    }