@extends('layouts.app')

   @section('content')
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <h1 class="text-2xl font-bold text-gray-900 mb-6">Profile</h1>
           <div class="bg-white shadow sm:rounded-lg p-6">
               <form method="POST" action="{{ route('profile.update') }}">
                   @csrf
                   @method('PATCH')
                   <div class="space-y-6">
                       <div>
                           <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                           <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                           @error('name')
                               <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                       </div>
                       <div>
                           <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                           <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                           @error('email')
                               <span class="text-red-600 text-sm">{{ $message }}</span>
                           @enderror
                       </div>
                       <div>
                           <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Update Profile</button>
                       </div>
                   </div>
               </form>
               <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Are you sure?')">Delete Account</button>
               </form>
           </div>
       </div>
   @endsection