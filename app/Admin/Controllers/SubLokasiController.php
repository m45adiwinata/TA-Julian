<?php

namespace App\Admin\Controllers;

use App\SubLokasi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SubLokasiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\SubLokasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SubLokasi());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('kapasitas', 'Kapasitas');

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
        $show = new Show(SubLokasi::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('kapasitas', 'Kapasitas');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SubLokasi());

        $form->text('nama', __('Nama'));
        $form->number('kapasitas', __('Kapasitas'));

        return $form;
    }
}
