<?php

namespace App\Admin\Controllers;

use App\Barang;
use App\Satuan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BarangController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Barang';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Barang());

        $grid->column('id', __('Id'));
        $grid->column('nama', __('Nama'));
        $grid->column('harga', __('Harga Beli'));
        $grid->column('harga_jual', __('Harga Jual'));
        $grid->column('satuan_id', __('Satuan id'))->display(function($satuan) {
            return Satuan::find($satuan)->nama;
        });
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
        $show = new Show(Barang::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama', __('Nama'));
        $show->field('harga', __('Harga Beli'));
        $show->field('harga_jual', __('Harga Jual'));
        $show->field('satuan_id', __('Satuan id'));
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
        $form = new Form(new Barang());

        $form->text('nama', __('Nama'));
        $form->decimal('harga', __('Harga Beli'));
        $form->decimal('harga_jual', __('Harga Jual'));
        $form->select('satuan_id', __('Satuan id'))->options(
            Satuan::get()->pluck('nama', 'id')
        );

        return $form;
    }
}
