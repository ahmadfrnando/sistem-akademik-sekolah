<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// start admin
// admin > dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('admin.dashboard'));
});

// admin > siswa
Breadcrumbs::for('admin.siswa.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Data Master Siswa', route('admin.siswa.index'));
});

// admin > guru
Breadcrumbs::for('admin.guru.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Data Master Guru', route('admin.guru.index'));
});
// admin > kelas
Breadcrumbs::for('admin.mapel.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Data Master Mapel', route('admin.mapel.index'));
});
// admin > mapel
Breadcrumbs::for('admin.kelas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Data Master Kelas', route('admin.kelas.index'));
});

// admin > kelola kelas
Breadcrumbs::for('admin.kelola-kelas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Kelola Data Kelas', route('admin.kelola-kelas.index'));
});

// admin > kelola kelas > detail
Breadcrumbs::for('admin.kelola-kelas.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kelola-kelas.index');
    $trail->push('Detail Kelas', route('admin.kelola-kelas.show', 'id'));
});

// end admin

// start guru
// guru > dashboard
Breadcrumbs::for('guru.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('guru.dashboard'));
});

// end guru