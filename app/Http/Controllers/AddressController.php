<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Auth::user()->profile->addresses;
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = $this->getCountries();
        $states = $this->getStates('México');
        $cities = $this->getCities('AGUASCALIENTES');
        return view('addresses.create', compact('countries', 'states', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $address = $profile->addresses()->create($request->all());

        // MIENVIO.MX
        $create_address_url = 'https://app.mienvio.mx/api/addresses';

        if($user->role == 'seller')
            $object_type = 'FROM';
        if($user->role == 'customer')
            $object_type = 'TO';

        $data_to = [
            'object_type' => $object_type,
            'street' => $address->address,
            'street2' => $address->address2,
            'name' => $profile->firstname . $profile->lastname,
            'email' => $user->email,
            'phone' => $profile->phone,
            'zipcode' => $address->zipcode,
            'alias' => $user->username
        ];
        $decoded_to = $this->callApi('POST', $create_address_url, $data_to);

        $address_to = $decoded_to->address->object_id;

        $address->update(['mienvio_object_id' => $address_to]);

        return redirect('admin/addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $countries = $this->getCountries();
        $states = $this->getStates('México');
        $cities = $this->getCities($address->state);
        return view('addresses.edit', compact('address', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect('admin/addresses');
    }

    public function getCountries()
    {
        $countries = ['México' => 'México'];
        return $countries;
    }

    public function getStates($country)
    {
        $mexico_json = file_get_contents(asset('json/mexico.json'));
        $mexico_array = json_decode($mexico_json, true);
        $states = [];
        foreach ($mexico_array['México']['estado'] as $states_array) {
            $states[$states_array['nombre']] = $states_array['nombre'];
        }
        return $states;
    }

    public function getCities($state)
    {
        $mexico_json = file_get_contents(asset('json/mexico.json'));
        $mexico_array = json_decode($mexico_json, true);
        $cities = [];
        foreach ($mexico_array['México']['estado'] as $states_array) {
            if($states_array['nombre'] == $state){
                $municipios = $states_array['municipios']['municipio'];
                foreach ($municipios as $key => $municipio) {
                    $cities[$municipio['nombre']] = $municipio['nombre'];
                }
            }
        }
        return $cities;
    }

    private function callApi($method, $url, $data = false)
    {
        $curl = curl_init($url);

        $headers = ['authorization: Bearer ' . env('MIENVIO_KEY')];

        if($method == 'POST'){
            curl_setopt($curl, CURLOPT_POST, true);
            if($data){
                $data = http_build_query($data);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);

        curl_close($curl);

        $decoded = json_decode($curl_response);

        return $decoded;
    }
}
