<?php

namespace App\Admin\Controllers;

use App\Pembelian;
use App\Suplier;
use App\Status;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PembelianController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pembelian';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pembelian());

        $grid->column('id', __('Id'));
        $grid->column('suplier_id', __('Suplier id'))->display(function($id) {
            return Suplier::find($id)->nama;
        });
        $grid->column('status_id', __('Status id'))->display(function($id) {
            return Status::find($id)->nama;
        });
        $grid->column('diskon', __('Diskon'));
        $grid->column('type_diskon_id', __('Type diskon id'));
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
        $show = new Show(Pembelian::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('suplier_id', __('Suplier id'));
        $show->field('status_id', __('Status id'));
        $show->field('diskon', __('Diskon'));
        $show->field('type_diskon_id', __('Type diskon id'));
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
        $form = new Form(new Pembelian());

        $form->number('suplier_id', __('Suplier id'));
        $form->number('status_id', __('Status id'));
        $form->decimal('diskon', __('Diskon'));
        $form->number('type_diskon_id', __('Type diskon id'));

        return $form;
    }
}
