<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Pengumuman;

class PengumumanController extends AdminController
{
    protected $title = 'Manajemen Pengumuman';

    protected function grid()
    {
        $grid = new Grid(new Pengumuman());

        $grid->column('id', __('No'))->sortable();
        $grid->column('title', __('Judul Pengumuman'))->limit(50);

        $grid->column('link_url', __('Tautan Eksternal'))->display(function ($url) {
            return $url ? '<a href="' . $url . '" target="_blank">Lihat Tautan</a>' : '—';
        });

        $grid->column('is_published', __('Status'))->display(function ($published) {
            return $published ? '<span class="badge bg-success">Terbit</span>' : '<span class="badge bg-warning">Draft</span>';
        });

        $grid->column('published_at', __('Tanggal Terbit'))->sortable();
        $grid->column('created_at', __('Dibuat'))->date('Y-m-d H:i');

        // Filter tetap ada
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('title', 'Judul');
            $filter->equal('is_published', 'Status Publikasi')->select([
                0 => 'Draft',
                1 => 'Terbit',
            ]);
            $filter->between('published_at', 'Tanggal Terbit')->datetime();
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Pengumuman::findOrFail($id));

        $show->field('title', __('Judul'));
        $show->field('link_url', __('Tautan Eksternal')); // Menggunakan link_url
        $show->field('is_published', __('Status Publikasi'))->as(function ($published) {
            return $published ? 'Terbit' : 'Draft';
        });
        $show->field('published_at', __('Tanggal Terbit'));

        $show->field('content', __('Isi Pengumuman'))->unescape()->as(function ($content) {
            return $content;
        });

        $show->field('created_at', __('Dibuat Pada'));
        $show->field('updated_at', __('Diperbarui Pada'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Pengumuman());

        $form->text('title', __('Judul Pengumuman'))->rules('required|max:255');

        // SOLUSI EDITOR: Menggunakan textarea standar
        $form->textarea('content', __('Isi Pengumuman'))->rules('required');

        // Field URL
        $form->url('link_url', __('Tautan Eksternal'))
            ->placeholder('Contoh: https://smk-nj.sch.id/info-detail');

        $form->datetime('published_at', __('Jadwal Terbit'))->default(null);
        $form->switch('is_published', __('Publikasikan?'))->default(1);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
