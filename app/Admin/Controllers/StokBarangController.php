<?php

namespace App\Admin\Controllers;

use App\StokBarang;
use App\Barang;
use App\Lokasi;
use App\SubLokasi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StokBarangController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\StokBarang';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StokBarang());

        $grid->column('id', __('Id'));
        $grid->column('barang_id', __('Barang id'))->display(function($id) {
            return Barang::find($id)->nama;
        });
        $grid->column('lokasi_id', __('Lokasi id'))->display(function($id) {
            return Lokasi::find($id)->nama;
        });
        $grid->column('sub_lokasi_id', __('Sub lokasi id'))->display(function($id) {
            return SubLokasi::find($id)->nama;
        });
        $grid->column('ketersediaan', 'Ketersediaan');
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
        $show = new Show(StokBarang::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('barang_id', __('Barang id'));
        $show->field('lokasi_id', __('Lokasi id'));
        $show->field('sub_lokasi_id', __('Sub lokasi id'));
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
        $form = new Form(new StokBarang());

        $form->select('barang_id', __('Barang id'))->options(
            Barang::get()->pluck('nama', 'id')
        );
        $form->select('lokasi_id', __('Lokasi id'))->options(
            Lokasi::get()->pluck('nama', 'id')
        );
        $form->select('sub_lokasi_id', __('Sub lokasi id'))->options(
            SubLokasi::get()->pluck('nama', 'id')
        );

        return $form;
    }
}
