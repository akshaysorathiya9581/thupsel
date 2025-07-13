<?php

namespace App\Http\Controllers;

use App\Models\ClientDetail;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Category;
use App\Models\ClientCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage client')) {
            $clients = User::where('parent_id', parentId())->where('type','client')->get();
            return view('client.index', compact('clients'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function create()
    {   
        $parts_category = Category::where('type', 'parts')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
        $service_category = Category::where('type', 'service')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();

        return view('client.create', compact('parts_category', 'service_category'));
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create client')) {
            $validator = \Validator::make(
                $request->all(), [
                    'service_cat_id' => 'array|required',
                    'parts_cat_id' => 'array|required',
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'service_address' => 'required',
                    'service_city' => 'required',
                    'service_state' => 'required',
                    'service_country' => 'required',
                    'service_zip_code' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalClient = $authUser->totalClient();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalClient >= $subscription->client_limit && $subscription->client_limit != 0) {
                return redirect()->back()->with('error', __('Your client limit is over, please upgrade your subscription.'));
            }
            $userRole = Role::findByName('client');
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = \Hash::make(123456);
            $user->type = $userRole->name;
            $user->profile = 'avatar.png';
            $user->lang = 'english';
            $user->parent_id = parentId();
            $user->save();
            $user->assignRole($userRole);

            if(!empty($user)){
                $client=new ClientDetail();
                $client->client_id=$this->clientNumber();
                $client->user_id=$user->id;
                $client->company=$request->company;
                $client->service_address=$request->service_address;
                $client->service_city=$request->service_city;
                $client->service_state=$request->service_state;
                $client->service_country=$request->service_country;
                $client->service_zip_code=$request->service_zip_code;
                if(isset($request->billing_info)){
                    $client->billing_address=$request->billing_address;
                    $client->billing_city=$request->billing_city;
                    $client->billing_state=$request->billing_state;
                    $client->billing_country=$request->billing_country;
                    $client->billing_zip_code=$request->billing_zip_code;
                }else{
                    $client->billing_address=$request->service_address;
                    $client->billing_city=$request->service_city;
                    $client->billing_state=$request->service_state;
                    $client->billing_country=$request->service_country;
                    $client->billing_zip_code=$request->service_zip_code;
                }
                $client->parent_id=parentId();
                $client->save();

                // Save parts categories
                if ($request->has('parts_cat_id')) {
                    foreach ($request->parts_cat_id as $partId) {
                        ClientCategory::create([
                            'user_id' => $user->id,
                            'cat_id' => $partId,
                            'type' => 'parts'
                        ]);
                    }
                }

                // Save service categories
                if ($request->has('service_cat_id')) {
                    foreach ($request->service_cat_id as $serviceId) {
                        ClientCategory::create([
                            'user_id' => $user->id,
                            'cat_id' => $serviceId,
                            'type' => 'service'
                        ]);
                    }
                }
            }
            return redirect()->route('client.index')->with('success', __('Client successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function show($ids)
    {
        $id=Crypt::decrypt($ids);
        $client=User::find($id);

        $partsCategories = $client->clientCategories()
            ->where('type', 'parts')
            ->with('category') // make sure you define `category()` relation in ClientCategory
            ->get();

        $serviceCategories = $client->clientCategories()
            ->where('type', 'service')
            ->with('category')
            ->get();

        return view('client.show',compact('client', 'partsCategories', 'serviceCategories'));
    }

    public function edit($id)
    {
        $user=User::find($id);

        $parts_category = Category::where('type', 'parts')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
        $service_category = Category::where('type', 'service')->orderBy('id', 'desc')->pluck('name', 'id')->toArray();

        // Get selected category IDs
        $selected_parts = $user->clientCategories()->where('type', 'parts')->pluck('cat_id')->toArray();
        $selected_services = $user->clientCategories()->where('type', 'service')->pluck('cat_id')->toArray();

        return view('client.edit',compact('user', 'parts_category', 'service_category', 'selected_parts', 'selected_services'));
    }

    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit client')) {
            $validator = \Validator::make(
                $request->all(), [
                    'service_cat_id' => 'array|required',
                    'parts_cat_id' => 'array|required',
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'service_address' => 'required',
                    'service_city' => 'required',
                    'service_state' => 'required',
                    'service_country' => 'required',
                    'service_zip_code' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->save();
            if(!empty($user)){
                $client=ClientDetail::where('user_id',$user->id)->first();
                $client->company=$request->company;
                $client->service_address=$request->service_address;
                $client->service_city=$request->service_city;
                $client->service_state=$request->service_state;
                $client->service_country=$request->service_country;
                $client->service_zip_code=$request->service_zip_code;
                $client->billing_address=$request->billing_address;
                $client->billing_city=$request->billing_city;
                $client->billing_state=$request->billing_state;
                $client->billing_country=$request->billing_country;
                $client->billing_zip_code=$request->billing_zip_code;
                $client->save();

                // Delete old category mappings
                ClientCategory::where('user_id', $user->id)->delete();

                // Re-insert parts categories
                if ($request->has('parts_cat_id')) {
                    foreach ($request->parts_cat_id as $partId) {
                        ClientCategory::create([
                            'user_id' => $user->id,
                            'cat_id' => $partId,
                            'type' => 'parts'
                        ]);
                    }
                }

                // Re-insert service categories
                if ($request->has('service_cat_id')) {
                    foreach ($request->service_cat_id as $serviceId) {
                        ClientCategory::create([
                            'user_id' => $user->id,
                            'cat_id' => $serviceId,
                            'type' => 'service'
                        ]);
                    }
                }
            }

            return redirect()->route('client.index')->with('success', __('Client successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('delete client')) {
            $user = User::find($id);
            $user->delete();
            ClientDetail::where('user_id',$id)->delete();
            return redirect()->route('client.index')->with('success', __('Client successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function clientNumber()
    {
        $lastClient = ClientDetail::where('parent_id', parentId())->latest()->first();
        if ($lastClient == null) {
            return 1;
        } else {
            return $lastClient->client_id + 1;
        }
    }
}