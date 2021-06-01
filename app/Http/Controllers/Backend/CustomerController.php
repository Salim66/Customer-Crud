<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Customers table view
     */
    public function view()
    {
        $all_data = Customer::all();
        return view('backend.customer.view-customer', [
            'all_data' => $all_data
        ]);
    }

    /**
     * Customer add page
     */
    public function add()
    {
        return view('backend.customer.add-customer');
    }

    /**
     * Customer data store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'phone'  => 'required',
            'email'  => 'required',
            'gender' => 'required'
        ]);

        // profile image upload
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/customers/'), $image_unique_name);
        }

        Customer::create([
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'profile_photo' => $image_unique_name
        ]);

        return redirect()->route('customers.view')->with('success', 'Customer added successfully ): ');
    }

    /**
     * Customer information view
     */
    public function show($id)
    {
        $data = Customer::find($id);
        return $data;
    }

    /**
     *  Customer delete
     */
    public function delete($id)
    {
        $data = Customer::find($id);
        if ($data != NULL) {
            if (file_exists('uploads/customers/' . $data->profile_photo) && !empty($data->profile_photo)) {
                unlink('uploads/customers/' . $data->profile_photo);
            }
            $data->delete();
            return redirect()->back()->with('success', 'Customer deleted successfully ): ');
        }
    }

    /**
     * Customer edit page
     */
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('backend.customer.edit-customer', [
            'data' => $data
        ]);
    }

    /**
     * Customer update
     */
    public function update(Request $request, $id)
    {
        $data = Customer::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name'   => 'required',
                'phone'  => 'required',
                'email'  => 'required',
                'gender' => 'required'
            ]);

            // profile image upload
            $image_unique_name = '';
            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/customers/'), $image_unique_name);
                if (file_exists('uploads/customers/' . $data->profile_photo) && !empty($data->profile_photo)) {
                    unlink('uploads/customers/' . $data->profile_photo);
                }
            } else {
                $image_unique_name = $data->profile_photo;
            }

            $data->name          = $request->name;
            $data->phone         = $request->phone;
            $data->email         = $request->email;
            $data->gender        = $request->gender;
            $data->profile_photo = $image_unique_name;
            $data->update();

            return redirect()->route('customers.view')->with('success', 'Customer updated successfully ): ');
        }
    }

    /**
     * Customer status update
     */
    public function statusUpdate(Request $request)
    {
        Customer::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }
}
