<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Electricity Bill Pricing') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="flex mt-10">
            <div class="bg-white overflow-hidden sm:rounded-lg px-10 w-1/2">
                <form class="w-full max-w-lg" method="post" action="{{ url('save-pricing') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-4xl p-5">Add Price List</h1>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-first-name">
                                Minimum Quantity
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="grid-first-name" type="text"
                                value=""
                                placeholder="Min Quantity" name="min">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-first-name">
                                Maximum Quantity
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="grid-first-name" type="text"
                                value=""
                                placeholder="Max Purchase Quantity" name="max">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-first-name">
                                Price per Unit
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="grid-first-name" type="text"
                                value=""
                                placeholder="Price per Unit" name="price">
                        </div>
                    </div>
                    <button
                        class="bg-gray-700 w-full hover:bg-gray-600 text-white font-bold py-2 px-4 border border-gray-700 rounded">
                        Save Pricing
                    </button>
                </form>
            </div>
            <div class="bg-white overflow-hidden sm:rounded-lg px-10 w-1/2">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                    <tr>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            #
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Min
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Max
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Price
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Pricing::all() as $price)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $price->min }}</td>
                            <td class="text-center">{{ $price->max }}</td>
                            <td class="text-center">{{ $price->price }}</td>
                            <td class="text-center"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
