<?php

namespace App\Http\Controllers;

use App\Models\BudgetItem;
use App\Models\Pharmacy;
use App\Models\ContributionRecord;
use App\Models\StockSubCategory;
use App\Models\User;
use App\Models\Utils;
use Dflydev\DotAccessData\Util;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ApiController extends BaseController
{

     public function file_uploading(Request $r)
    {
            //die("Time to upload file");
        $path = Utils::file_upload($r->file('photo'));
         if ($path == '') {
            Utils::error("File not uploaded.");
        }
        Utils::success([
            'file_name' => $path,
        ], "File uploaded successfully.");
    }

     public function manifest(Request $r)
     {
        $u = Utils::get_user($r);
        if ($u == null) {
            Utils::error("Unauthonticated.");
        }
        $roles = DB::table('admin_role_users')->where('user_id', $u->id)->get();
        $pharmacy = Pharmacy::find($u->pharmacy_id);
        $data = [
            'name' => 'Invetor-Tracking',
            'short_name' => 'IT',
            'description' => 'Inventory Management System',
            'version' => '1.0.0',
            'author' => 'Mohammed A.',
            'user' => $u,
            'roles' => $roles,
            'pharmacy' => $pharmacy,
        ];
        Utils::success($data, "Success.");
     }

    public function my_list(Request $r, $model)
    {
        $u = Utils::get_user($r);
        if ($u == null) {
            Utils::error("Unauthonticated.");
        }
        $model = "App\Models\\" . $model;
        $data = $model::where('pharmacy_id', $u->pharmacy_id)->limit(100000)->get();
        Utils::success($data, "Listed successfully.");
    }





    // public function budget_item_create(Request $r)
    // {
    //     $u = Utils::get_user($r);
    //     if ($u == null) {
    //         Utils::error("Unauthonticated.");
    //     }
    //     $model = BudgetItem::class;
    //     $object = BudgetItem::find($r->get('id'));
    //     $isEdit = true;
    //     if ($object == null) {
    //         $object = new $model();
    //         $isEdit = false;
    //     }


    //     $table_name = $object->getTable();
    //     $columns = Schema::getColumnListing($table_name);
    //     $except = ['id', 'created_at', 'updated_at'];
    //     $data = $r->all();


    //     foreach ($data as $key => $value) {
    //         if (!in_array($key, $columns)) {
    //             continue;
    //         }
    //         if (in_array($key, $except)) {
    //             continue;
    //         }
    //         if ($value == null) {
    //             continue;
    //         }
    //         if ($value == '') {
    //             continue;
    //         }
    //         $object->$key = $value;
    //     }
    //     $object->pharmacy_id = $u->pharmacy_id;

    //     try {
    //         $object->save();
    //     } catch (\Exception $e) {
    //         Utils::error($e->getMessage());
    //     }
    //     if ($object == null) {
    //         Utils::error("Failed to save.");
    //     }

    //     $new_object = $model::find($object->id);

    //     if ($isEdit) {
    //         Utils::success($new_object, "Updated successfully.");
    //     } else {
    //         Utils::success($new_object, "Created successfully.");
    //     }
    // }





    // public function contribution_records_create(Request $r)
    // {
    //     $u = Utils::get_user($r);
    //     if ($u == null) {
    //         Utils::error("Unauthonticated.");
    //     }

    //     $treasurer = null;
    //     //check if treasurer_id is not set and abort
    //     if ($r->treasurer_id == null) {
    //         Utils::error("Treasurer is required.");
    //     } else {
    //         $treasurer = User::find($r->treasurer_id);
    //         if ($treasurer == null) {
    //             Utils::error("Treasurer not found.");
    //         }
    //     }

    //     $model = ContributionRecord::class;
    //     $object = ContributionRecord::find($r->get('id'));
    //     $isEdit = true;
    //     if ($object == null) {
    //         $object = new $model();
    //         $isEdit = false;
    //     }


    //     $table_name = $object->getTable();
    //     $columns = Schema::getColumnListing($table_name);
    //     $except = ['id', 'created_at', 'updated_at'];
    //     $data = $r->all();


    //     foreach ($data as $key => $value) {
    //         if (!in_array($key, $columns)) {
    //             continue;
    //         }
    //         if (in_array($key, $except)) {
    //             continue;
    //         }
    //         if ($value == null) {
    //             continue;
    //         }
    //         if ($value == '') {
    //             continue;
    //         }
    //         $object->$key = $value;
    //     }
    //     $object->pharmacy_id = $u->pharmacy_id;
    //     $object->treasurer_id = $treasurer->id; //set treasurer_id

    //     try {
    //         $object->save();
    //     } catch (\Exception $e) {
    //         Utils::error($e->getMessage());
    //     }
    //     if ($object == null) {
    //         Utils::error("Failed to save.");
    //     }

    //     $new_object = $model::find($object->id);

    //     if ($isEdit) {
    //         Utils::success($new_object, "Updated successfully.");
    //     } else {
    //         Utils::success($new_object, "Created successfully.");
    //     }
    // }





    public function my_update(Request $r, $model)
    {
        $u = Utils::get_user($r);
        if ($u == null) {
            Utils::error("Unauthonticated.");
        }
        $model = "App\Models\\" . $model;
         $object = $model::find($r->get('id'));
        // $object = $model::find($r->id);
        $isEdit = true;
        if ($object == null) {
            $object = new $model();
            $isEdit = false;
        }


        $table_name = $object->getTable();
        $columns = Schema::getColumnListing($table_name);
        $except = ['id', 'created_at', 'updated_at'];
        $data = $r->all();

        foreach ($data as $key => $value) {
            if (!in_array($key, $columns)) {
                continue;
            }
            if (in_array($key, $except)) {
                continue;
            }
            if ($value == null) {
                continue;
            }
            if ($value == '') {
                continue;
            }
            $object->$key = $value;
        }
       $object->pharmacy_id = $u->pharmacy_id;


        //temp_image_field
        if ($r->temp_file_field != null) {
            if (strlen($r->temp_file_field) > 1) {
                $file  = $r->file('photo');
                if ($file != null) {
                    $path = "";
                    try {
                        $path = Utils::file_upload($r->file('photo'));
                    } catch (\Exception $e) {
                        $path = "";
                    }
                    if (strlen($path) > 3) {
                        $fiel_name = $r->temp_file_field;
                        $object->$fiel_name = $path;
                    }
                }
            }
        }

        try {
            $object->save();
        } catch (\Exception $e) {
            Utils::error($e->getMessage());
        }
        $new_object = $model::find($object->id);

        if ($isEdit) {
            Utils::success($new_object, "Updated successfully.");
        } else {
            Utils::success($new_object, "Created successfully.");
        }
    }


    public function login(Request $r)
    {
        //check if email is provided
        if ($r->email == null) {
            Utils::error("Email is required.");
        }
        //check if email is valid
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            //Utils::error("Email is invalid.");
        }

        //check if password is provided
        if ($r->password == null) {
            Utils::error("Password is required.");
        }

        $user = User::where('email', $r->email)->first();
        if ($user == null) {
            Utils::error("Account not found.");
        }

        if (!password_verify($r->password, $user->password)) {
            Utils::error("Invalid password.");
        }

        $pharmacy = Pharmacy::find($user->pharmacy_id);
        if ($pharmacy == null) {
            Utils::error("Pharmacy not found.");
        }

        Utils::success([
            'user' => $user,
            'pharmacy' => $pharmacy,
        ], "Login successful.");
    }


    public function register(Request $r)
    {

        if ($r->first_name == null) {
            Utils::error("First name is required.");
        }
        //check if last name is provided
        if ($r->last_name == null) {
            Utils::error("Last name is required.");
        }
        //check if email is provided
        if ($r->email == null) {
            Utils::error("Email is required.");
        }
        //check if email is valid
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            Utils::error("Email is invalid.");
        }

        //check if email is already registered
        $u = User::where('email', $r->email)->first();
        if ($u != null) {
            Utils::error("Email is already registered.");
        }
        //check if password is provided
        if ($r->password == null) {
            Utils::error("Password is required.");
        }

        //check if pharmacy name is provided
        if ($r->pharmacy_name == null) {
            Utils::error("Pharmacy name is required.");
        }
        if ($r->currency == null) {
            Utils::error("Currency is required.");
        }

        $new_user = new User();
        $new_user->first_name = $r->first_name;
        $new_user->last_name = $r->last_name;
        $new_user->username = $r->email;
        $new_user->email = $r->email;
        $new_user->password = password_hash($r->password, PASSWORD_DEFAULT);
        $new_user->name = $r->first_name . " " . $r->last_name;
        $new_user->phone_number = $r->phone_number;
        $new_user->pharmacy_id = 1;
        $new_user->status = "Active";

        try {
            $new_user->save();
        } catch (\Exception $e) {
            Utils::error($e->getMessage());
        }

        $registered_user = User::find($new_user->id);
        if ($registered_user == null) {
            Utils::error("Failed to register user.");
        }

        $pharmacy = new Pharmacy();
        $pharmacy->owner_id = $registered_user->id;
        $pharmacy->name = $r->pharmacy_name;
        $pharmacy->email = $r->email;
        $pharmacy->phone_number = $r->phone_number;
        $pharmacy->status = 'Active';
        $pharmacy->currency = $r->currency;
        $pharmacy->license_expire = date('Y-m-d', strtotime("+1 year"));

        try {
            $pharmacy->save();
        } catch (\Exception $e) {
            Utils::error($e->getMessage());
        }

        $registered_pharmacy = Pharmacy::find($pharmacy->id);
        if ($registered_pharmacy == null) {
            Utils::error("Failed to register pharmacy.");
        }

        //DB instert into admin_role_users
        DB::table('admin_role_users')->insert([
            'user_id' => $registered_user->id,
            'role_id' => 2,
        ]);

        Utils::success([
            'user' => $registered_user,
            'pharmacy' => $registered_pharmacy,
        ], "Registration successful.");
    }
}
