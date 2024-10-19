<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
</head>
<body>
    <div class="flex justify-center items-center mt-10">
        <div class="flex flex-col w-1/2 ">
            <div class="overflow-x-auto">
                <div class="inline-block align-middle w-full">
                    <div class="flex justify-between items-center mb-4">
                        <!-- Search input -->
                        <div class="relative text-gray-500 focus-within:text-gray-900 w-auto">
                            <input type="text" id="default-search" class="block w-64 h-11 pr-5 pl-12 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Search for company">
                        </div>
                        <!-- Create button -->
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                            Create
                        </button>
                    </div>

                    <div class="overflow-hidden">
                        <table class="min-w-full w-full rounded-xl">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl"> NIP</th>
                                    <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Nama Guru</th>
                                    <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Password </th>
                                    <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Email Guru </th>
                                    <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Status </th>
                                    <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl"> Actions </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                                <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> Louis Vuitton </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> Customer </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> Accessories </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        <span class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full">Active</span>
                                    </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        <a href="#" class="text-blue-500 hover:text-blue-700">
                                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> Apple </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010511 </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> Partner </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> Electronics </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        <span class="px-3 py-1 text-xs font-medium text-white bg-yellow-500 rounded-full">Pending</span>
                                    </td>
                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                        <a href="#" class="text-blue-500 hover:text-blue-700">
                                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
