<?php

namespace App\Admin\Controllers;

use App\Models\Country;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CountryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '国家管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Country);

        $grid->column('id', __('Id'));
        $grid->column('name', __('国家名称'));
        $grid->column('money_sign', __('货币符号'));
        $grid->column('global_lang', __('语言标识'));
        $grid->column('global_email', __('Email'));
        $grid->column('global_phone', __('电话'));
        $grid->column('global_address', __('地址'));
        $grid->column('global_title', __('网站名称'));
        $grid->column('global_keywords', __('关键词'));
        $grid->column('global_description', __('站点描述'));
        $grid->column('order_prefix', __('订单前缀'));
        // $grid->column('sms_msg', __('短信'));

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
        $show = new Show(Country::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('国家名称'));
        $show->field('money_sign', __('货币符号'));
        $show->field('global_lang', __('语言标识'));
        $show->field('global_email', __('Email'));
        $show->field('global_phone', __('电话'));
        $show->field('global_address', __('地址'));
        $show->field('global_title', __('网站名称'));
        $show->field('global_keywords', __('关键词'));
        $show->field('global_description', __('站点描述'));
        $show->field('order_prefix', __('订单前缀'));
        // $show->field('sms_msg', __('Sms msg'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Country);

        $form->text('name', __('国家名称'));
        $form->text('money_sign', __('货币符号'));
        $form->text('global_lang', __('语言标识'));
        $form->email('global_email', __('Email'));
        $form->text('global_phone', __('电话'));
        $form->text('global_address', __('地址'));
        $form->text('global_title', __('网站名称'));
        $form->text('global_keywords', __('关键词'));
        $form->text('global_description', __('站点描述'));
        $form->text('order_prefix', __('订单前缀'));
        // $form->text('sms_msg', __('Sms msg'));

        return $form;
    }
}
