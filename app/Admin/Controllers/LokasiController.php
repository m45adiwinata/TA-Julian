<?php

namespace App\Admin\Controllers;

use App\Lokasi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LokasiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Lokasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lokasi());

        $grid->column('id', __('Id'));
        $grid->column('kode', __('Kode'));
        $grid->column('nama', __('Nama'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Lokasi::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('kode', __('Kode'));
        $show->field('nama', __('Nama'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Lokasi());

        $form->text('kode', __('Kode'));
        $form->text('nama', __('Nama'));

        return $form;
    }
}
