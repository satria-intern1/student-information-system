<section
   x-data="{ showAlert: true }"
   x-show="showAlert"
   @click="showAlert = false"
   x-init="setTimeout(() => showAlert = false, 5000)"

   x-transition:enter="ease-out duration-300"
   x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
   x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
   x-transition:leave="ease-in duration-200"
   x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
   x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
   
   class="hover:cursor-pointer fixed top-5 left-1/2 transform -translate-x-1/2 border-stroke mb-11 flex items-center rounded-md border bg-white p-5 pl-8 shadow-lg z-50"
   >
   <div class="w-full">
      <h5 class="mb-3 text-base font-semibold text-[#BC1C21]">
         There are errors with your submission
      </h5>
      <ul class="list-inside list-disc">
         {{ $slot }}
      </ul>
   </div>
</section>


{{-- 
<x-alert-error>
@foreach ($errors->all() as $error)
    <li class="text-red-light text-base leading-relaxed">
        {{ $error }}</li>
@endforeach
</x-alert-error>
--}}