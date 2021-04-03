@extends('layouts.master')
@section('title', 'Glossar')
@section('header_pagetitle', 'Glossar')

@section('content')
<!--  <template> -->
  <div class="flex flex-wrap py-2">
    <div class="w-full px-4">
      <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-pink-500 rounded">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
          <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start">
            <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white" href="#pablo">
              pink Starter Menu
            </a>
            <button class="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" v-on:click="toggleNavbar()">
              <i class="fas fa-bars"></i>
            </button>
          </div>
          <div v-bind:class="{'hidden': !menuShow, 'flex': menuShow}" class="lg:flex lg:flex-grow items-center">
            <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
              <li class="nav-item">
                <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75" href="#pablo">
                  Discover
                </a>
              </li>
              <li class="nav-item">
                <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75" href="#pablo">
                  Profile
                </a>
              </li>
              <li class="nav-item">
                <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75" href="#pablo">
                  Settings
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
<!-- </template> -->

<!-- component -->
<div class="p-3">
    <button onclick="openModal(true)" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">
        Open Modal
    </button>
</div>

<!-- overlay -->
<div id="modal_overlay" class="hidden absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">

<!-- modal -->
<div id="modal" class="pacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

    <!-- button close -->
    <button 
    onclick="openModal(false)"
    class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
    &cross;
    </button>

    <!-- header -->
    <div class="px-4 py-3 border-b border-gray-200">
    <h2 class="text-xl font-semibold text-gray-600">Title</h2>
    </div>

    <!-- body -->
    <div class="w-full p-3">
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores, quis tempora! Similique, explicabo quaerat maxime corrupti tenetur blanditiis voluptas molestias totam? Quaerat laboriosam suscipit repellat aliquam blanditiis eum quos nihil.
    </div>

    <!-- footer -->
    <div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
    <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">Save</button>
    <button 
        onclick="openModal(false)"
        class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
    >Close</button>
    </div>
</div>

</div>

<script>
const modal_overlay = document.querySelector('#modal_overlay');
const modal = document.querySelector('#modal');

function openModal (value){
    const modalCl = modal.classList
    const overlayCl = modal_overlay

    if(value){
    overlayCl.classList.remove('hidden')
    setTimeout(() => {
        modalCl.remove('opacity-0')
        modalCl.remove('-translate-y-full')
        modalCl.remove('scale-150')
    }, 100);
    } else {
    modalCl.add('-translate-y-full')
    setTimeout(() => {
        modalCl.add('opacity-0')
        modalCl.add('scale-150')
    }, 100);
    setTimeout(() => overlayCl.classList.add('hidden'), 300);
    }
}
openModal(true)
</script>

<script>

</script>
@endsection