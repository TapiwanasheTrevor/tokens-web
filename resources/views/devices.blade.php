<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Device Usage') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="flex mt-10">
            <div class="bg-white overflow-hidden sm:rounded-lg px-10 w-1/2">
                <form class="w-full max-w-lg" method="post" action="{{ url('save-appliance') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap -mx-3">
                        <h1 class="text-4xl p-5">Add Appliances</h1>
                        <hr/>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-first-name">
                                Appliance Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="grid-first-name" type="text" placeholder="Iron" required name="name">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-last-name">
                                Appliance Icon
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded pt-2 pb-1 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="file" required name="icon">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-5">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-password">
                                Description
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-password" type="text" required placeholder="Steam irons and related"
                                name="description">
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-city">
                                Wattage
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-city" type="text" placeholder="200" required name="wattage">
                        </div>
                    </div>
                    <button
                        class="bg-gray-700 w-full hover:bg-gray-600 text-white font-bold py-2 px-4 border border-gray-700 rounded">
                        Save Appliance Details
                    </button>
                </form>
            </div>
            <div class="bg-white overflow-hidden sm:rounded-lg py-10 w-1/2">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                    <tr>
                        <td class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            #
                        </td>
                        <td class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Icon
                        </td>
                        <td class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Device
                        </td>
                        <td class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Wattage
                        </td>
                        <td class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Action
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Device::all() as $device)
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center"><img style="height: 30px" src="{{ $device->icon }}"></td>
                            <td class="text-center">{{ $device->name }}</td>
                            <td class="text-center">{{ $device->wattage }}</td>
                            <td class="text-center">Delete</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
