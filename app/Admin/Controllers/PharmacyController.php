<?php

namespace App\Admin\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class PharmacyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pharmacy';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pharmacy());

        $grid->disableBatchActions();
        $grid->quickSearch('name', 'phone_number', 'phone_number_2', 'email');

        $grid->column('id', __('Id'))->hide();
        $grid->column('created_at', __('Registered'))
        ->display(function ($created_at) {
            return date('Y-m-d', strtotime($created_at));
        })->sortable();
        $grid->column('owner_id', __('Owner'))->display(function ($owner_id) {
            $user = User::find($owner_id);
            if ($user == null) {
                return 'Not found';
            }
            return $user->name;
        })->sortable();
        $grid->column('name', __('Pharmacy Name'));
        $grid->column('email', __('Email'));
        $grid->column('about', __('About'))->hide();
        $grid->column('status', __('Status'))
            ->display(function ($status) {
                return $status == 'active' ? 'Active' : 'Inactive';
            })->sortable();
        $grid->column('license_expire', __('License Expire'))
            ->display(function ($license_expire) {
                return date('Y-m-d', strtotime($license_expire));
            })->sortable();
        $grid->column('address', __('Address'))->hide();
        $grid->column('phone_number', __('Phone Number'))->hide();
        $grid->column('phone_number_2', __('Phone number 2'))->hide();
        $grid->column('pobox', __('Pobox'))->hide();
        $grid->column('slogan', __('Slogan'))->hide();
        $grid->column('facebook', __('Facebook'))->hide();

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
        $show = new Show(Pharmacy::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('owner_id', __('Owner id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('logo', __('Logo'));
        $show->field('status', __('Status'));
        $show->field('license_expire', __('License expire'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('phone_number_2', __('Phone number 2'));
        $show->field('pobox', __('Pobox'));
        $show->field('slogan', __('Slogan'));
        $show->field('facebook', __('Facebook'));
        $show->field('about', __('About'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // $pharm = Pharmacy::find(1);
        // $pharm->name = $pharm->name.' - '.rand(1,100);
        // $pharm->save();
        // die("done");

        //get admin_role_users records with where condition
        $admin_role_users = DB::table('admin_role_users')->where([
            'role_id' => 2,
        ])->get();


        $pharmacy_admins = [];

        foreach ($admin_role_users as $key => $value) {
            $user = User::find($value->user_id);
            if ($user == null) {
                continue;
            }
            $pharmacy_admins[$user->id] = $user->name . ' - ' . $user->id;
        }
        $form = new Form(new Pharmacy());

        $form->select('owner_id', __('Pharmacy owner'))
            ->options($pharmacy_admins)
            ->rules('required');
        $form->text('name', __('Pharmacy Name'));
        $form->email('email', __('Email'));
        $form->image('logo', __('Logo'));
        $form->text('status', __('Status'));
        $form->date('license_expire', __('License expire'))->default(date('Y-m-d'));
        $form->text('address', __('Address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('phone_number_2', __('Phone number 2'));
        $form->text('pobox', __('Pobox'));
        $form->text('slogan', __('Slogan'));
        $form->url('facebook', __('Facebook'));
        $form->text('about', __('About'));

        return $form;
    }
}
