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

// admin > kelola guru kelas
Breadcrumbs::for('admin.kelola-guru-kelas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Daftar Kelas', route('admin.kelola-guru-kelas.index'));
});

// admin > kelola guru kelas > detail
Breadcrumbs::for('admin.kelola-guru-kelas.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kelola-guru-kelas.index');
    $trail->push('Daftar Guru Kelas', route('admin.kelola-guru-kelas.show', 'id'));
});

// admin > kelola siswa kelas
Breadcrumbs::for('admin.kelola-siswa-kelas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Daftar Kelas', route('admin.kelola-siswa-kelas.index'));
});

// admin > kelola siswa kelas > detail
Breadcrumbs::for('admin.kelola-siswa-kelas.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kelola-siswa-kelas.index');
    $trail->push('Daftar Siswa Kelas', route('admin.kelola-siswa-kelas.show', 'id'));
});

// admin > akun
Breadcrumbs::for('admin.user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Update Akun', route('admin.user.index'));
});

// end admin

// start guru
// guru > dashboard
Breadcrumbs::for('guru.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('guru.dashboard'));
});

// guru > data siswa 
Breadcrumbs::for('guru.data-siswa.index', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.dashboard');
    $trail->push('Daftar Kelas', route('guru.data-siswa.index'));
});

// guru > data siswa > show
Breadcrumbs::for('guru.data-siswa.show', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.data-siswa.index');
    $trail->push('Detail Siswa Kelas', route('guru.data-siswa.show', 'id'));
});

// guru > kelola pembelajaran
Breadcrumbs::for('guru.kelola-pembelajaran.index', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.dashboard');
    $trail->push('Daftar Kelas', route('guru.kelola-pembelajaran.index'));
});

// guru > kelola pembelajaran > show
Breadcrumbs::for('guru.kelola-pembelajaran.show', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.kelola-pembelajaran.index');
    $trail->push('Materi Pelajaran', route('guru.kelola-pembelajaran.show', 'id'));
});

// guru > kelola pembelajaran > show > detail response
Breadcrumbs::for('guru.kelola-pembelajaran.diskusi-materi', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.kelola-pembelajaran.show');
    $trail->push('Diskusi Materi Pembelajaran', route('guru.kelola-pembelajaran.diskusi-materi', 'id'));
});

// admin > akun
Breadcrumbs::for('guru.user.edit-username', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.dashboard');
    $trail->push('Update Username', route('guru.user.edit-username'));
});

// admin > akun
Breadcrumbs::for('guru.user.edit-password', function (BreadcrumbTrail $trail) {
    $trail->parent('guru.dashboard');
    $trail->push('Update Password', route('guru.user.edit-password'));
});

// end guru

// start siswa
// dashboard
Breadcrumbs::for('siswa.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Pages', route('siswa.dashboard'));
});

// siswa > tugas
Breadcrumbs::for('siswa.tugas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('siswa.dashboard');
    $trail->push('Daftar Mata Pelajaran', route('siswa.tugas.index'));
});

// siswa > tugas > materi
Breadcrumbs::for('siswa.tugas.list-materi', function (BreadcrumbTrail $trail) {
    $trail->parent('siswa.tugas.index');
    $trail->push('Materi', route('siswa.tugas.list-materi', 'mapel_id'));
});

// siswa > tugas > materi > detail materi
Breadcrumbs::for('siswa.tugas.show-materi', function (BreadcrumbTrail $trail) {
    $trail->parent('siswa.tugas.list-materi');
    $trail->push('Detail Materi', route('siswa.tugas.show-materi', 'materi_id'));
});

// end siswa