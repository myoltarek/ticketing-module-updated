<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommonMailCcFormValidation;
use App\Models\CommonMailCc;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommonMailCcController extends Controller
{
    public function index()
    {
        $common_mail_ccs = CommonMailCc::all();
        return view('common_mail_cc.index', get_defined_vars());
    }

    public function create()
    {
        return view('common_mail_cc.create');
    }

    public function store(CommonMailCcFormValidation $request)
    {
        // dd($request);
        $common_mail_cc = new CommonMailCc;
        $this->dataStore($common_mail_cc,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('common-mail-cc');
    }

    public function edit($id)
    {
        $common_mail_cc = CommonMailCc::find($id);

        return view('common_mail_cc.edit', compact('common_mail_cc'));
    }

    public function update(CommonMailCcFormValidation $request, $id)
    {
        $common_mail_cc = CommonMailCc::find($id);
        $this->dataStore($common_mail_cc,$request);

        Alert::success('Success', 'Successfully updated');
        return redirect('common-mail-cc');
    }

    public function destroy($id)
    {
        try {
            CommonMailCc::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');

          } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
          }
    }

    protected function dataStore($common_mail_cc,$request)
    {
        $common_mail_cc->name = $request->name;
        $common_mail_cc->email = $request->email;
        $common_mail_cc->save();
    }
}
