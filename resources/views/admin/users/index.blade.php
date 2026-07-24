@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Kelola Akun</h1>

        <div class="flex justify-between sm:justify-end items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="px-3 py-1.5 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700 transition text-xs font-semibold text-center">
                ← Back
            </a>

            <a href="{{ route('admin.pendidik.create') }}"
               class="px-3 py-1.5 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition text-xs font-semibold text-center">
                + Add User
            </a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Role</th>
                        <th class="p-3 border text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">{{ $user->id_user }}</td>
                        <td class="p-3 border">{{ $user->name }}</td>
                        <td class="p-3 border">{{ $user->email }}</td>
                        <td class="p-3 border">{{ $user->role }}</td>

                        <td class="p-3 border text-center">

                            <a href="{{ route('admin.users.edit', $user->id_user) }}"
                               class="px-3 py-1 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition mr-2">
                                ✏ Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id_user) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-1 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    🗑 Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
