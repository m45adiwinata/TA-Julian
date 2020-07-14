<?php

namespace App\Admin\Controllers;

use App\Penjualan;
use App\Pelanggan;
use App\Sales;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PenjualanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Penjualan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Penjualan());

        $grid->column('id', __('Id'));
        $grid->column('pelanggan_id', __('Pelanggan id'))->display(function($id) {
            return Pelanggan::find($id)->nama;
        });
        $grid->column('sales_id', __('Sales id'))->display(function($id) {
            return Sales::find($id)->nama;
        });
        $grid->column('diskon', __('Diskon'));
        $grid->column('type_diskon', __('Type diskon'));
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
        $show = new Show(Penjualan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pelanggan_id', __('Pelanggan id'));
        $show->field('sales_id', __('Sales id'));
        $show->field('diskon', __('Diskon'));
        $show->field('type_diskon', __('Type diskon'));
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
        $form = new Form(new Penjualan());

        $form->number('pelanggan_id', __('Pelanggan id'));
        $form->number('sales_id', __('Sales id'));
        $form->decimal('diskon', __('Diskon'));
        $form->number('type_diskon', __('Type diskon'));

        return $form;
    }
}
