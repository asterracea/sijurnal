@extends('layouts.admin')

@section('title', 'SiJurnal Guru - Form')

@section('content')

<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
        <div>
            <h2 class="font-semibold text-xl text-gray-600">Form Jurnal</h2>
            <p class="text-gray-500 mb-6">Silahkan isi form jurnal sesuai dengan jadwal.</p>

            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5">
                                <label for="full_name">Tahun Pelajaran</label>
                                <input type="text" name="full_name" id="full_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>
                            <div class="md:col-span-5">
                                <label for="email">Semester</label>
                                <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  />
                            </div>
                            <div class="md:col-span-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>
                            <div class="md:col-span-2">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>
                            <div class="md:col-span-2">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>
                            <div class="md:col-span-2">
                                <label for="state">State/Province</label>
                                <input type="text" name="state" id="state" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>
                            <div class="md:col-span-1">
                                <label for="zipcode">Zipcode</label>
                                <input type="text" name="zipcode" id="zipcode" class="transition-all h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                            </div>
                            <div class="md:col-span-5 text-right">
                                <div class="inline-flex items-end">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
