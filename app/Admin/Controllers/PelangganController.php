<?php

namespace App\Admin\Controllers;

use App\Pelanggan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PelangganController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Pelanggan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pelanggan());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('alamat', __('Alamat'));
        $grid->column('no_telp', __('No telp'));
        $grid->column('contact_person', __('Contact person'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Pelanggan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('alamat', __('Alamat'));
        $show->field('no_telp', __('No telp'));
        $show->field('contact_person', __('Contact person'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Pelanggan());

        $form->text('nama', __('Nama'));
        $form->textarea('alamat', __('Alamat'));
        $form->text('no_telp', __('No telp'));
        $form->text('contact_person', __('Contact person'));

        return $form;
    }
}
