<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > User
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('User', route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push('Create User', route('users.create'));
});

Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->name, route('users.show', $user->id));
});

Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.show',$user);
    $trail->push('Edit', route('users.edit', $user->id));
});

Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Profile', route('profile'));
});

Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles');
    $trail->push('Create Roles', route('roles.create'));
});

Breadcrumbs::for('roles.show', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push($role->name, route('roles.show', $role->id));
});

Breadcrumbs::for('roles.edit', function ($trail, $role) {
    $trail->parent('roles.show',$role);
    $trail->push('Edit', route('roles.edit', $role->id));
});

Breadcrumbs::for('lembaga', function ($trail) {
    $trail->parent('home');
    $trail->push('Lembaga Pendidikan', route('lembaga.index'));
});

Breadcrumbs::for('lembaga.create', function ($trail) {
    $trail->parent('lembaga');
    $trail->push('Tambah', route('lembaga.create'));
});

Breadcrumbs::for('lembaga.show', function ($trail, $role) {
    $trail->parent('lembaga');
    $trail->push($role->name, route('lembaga.show', $role->id));
});

Breadcrumbs::for('lembaga.edit', function ($trail, $role) {
    $trail->parent('lembaga.show',$role);
    $trail->push('Edit', route('lembaga.edit', $role->id));
});

Breadcrumbs::for('tingkat', function ($trail) {
    $trail->parent('home');
    $trail->push('Tingkat Pendidikan', route('tingkat.index'));
});

Breadcrumbs::for('tingkat.create', function ($trail) {
    $trail->parent('tingkat');
    $trail->push('Tambah', route('tingkat.create'));
});

Breadcrumbs::for('tingkat.show', function ($trail, $role) {
    $trail->parent('tingkat');
    $trail->push($role->name, route('tingkat.show', $role->id));
});

Breadcrumbs::for('tingkat.edit', function ($trail, $role) {
    $trail->parent('tingkat.show',$role);
    $trail->push('Edit', route('tingkat.edit', $role->id));
});

Breadcrumbs::for('kelas', function ($trail) {
    $trail->parent('home');
    $trail->push('Kelas Pendidikan', route('kelas.index'));
});

Breadcrumbs::for('kelas.create', function ($trail) {
    $trail->parent('kelas');
    $trail->push('Tambah', route('kelas.create'));
});

Breadcrumbs::for('kelas.show', function ($trail, $role) {
    $trail->parent('kelas');
    $trail->push($role->kode, route('kelas.show', $role->id));
});

Breadcrumbs::for('kelas.edit', function ($trail, $role) {
    $trail->parent('kelas.show',$role);
    $trail->push('Edit', route('kelas.edit', $role->id));
});

Breadcrumbs::for('siswa', function ($trail) {
    $trail->parent('home');
    $trail->push('Siswa', route('siswa.index'));
});

Breadcrumbs::for('siswa.create', function ($trail) {
    $trail->parent('siswa');
    $trail->push('Tambah', route('siswa.create'));
});

Breadcrumbs::for('siswa.show', function ($trail, $role) {
    $trail->parent('siswa');
    $trail->push($role->kode, route('siswa.show', $role->id));
});

Breadcrumbs::for('siswa.edit', function ($trail, $role) {
    $trail->parent('siswa.show',$role);
    $trail->push('Edit', route('siswa.edit', $role->id));
});

Breadcrumbs::for('coa_parent', function ($trail) {
    $trail->parent('home');
    $trail->push('Coa Parent', route('coa_parent.index'));
});
Breadcrumbs::for('coa', function ($trail) {
    $trail->parent('home');
    $trail->push('Coa', route('coa.index'));
});


// Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });
