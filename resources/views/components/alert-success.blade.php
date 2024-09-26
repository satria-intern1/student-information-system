<section
    x-data="{ showSuccess: true }"
    x-show="showSuccess"
    x-init="setTimeout(() => showSuccess = false, 3000)"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    class=" fixed top-5 left-1/2 transform -translate-x-1/2 border-stroke mb-11 flex items-center rounded-md border bg-white p-5 pl-8 shadow-lg z-50"
>
    <div
        class="mr-5 flex h-[36px] w-full max-w-[36px] items-center justify-center rounded-full bg-[#00B078]"
    >
        <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M17.4038 4.22274C17.883 4.70202 17.883 5.47909 17.4038 5.95837L8.40377 14.9584C7.92449 15.4376 7.14742 15.4376 6.66814 14.9584L2.57723 10.8675C2.09795 10.3882 2.09795 9.61111 2.57723 9.13183C3.05651 8.65255 3.83358 8.65255 4.31286 9.13183L7.53595 12.3549L15.6681 4.22274C16.1474 3.74346 16.9245 3.74346 17.4038 4.22274Z"
                fill="white"
            />
        </svg>
    </div>
    <div class="flex w-full items-center justify-between">
        <div>
            <p class="text-sm text-green-600">
                {{ $slot }}
            </p>
        </div>
        <div>
            <button class="hover:text-danger text-[#ACACB0]" @click="showSuccess = false">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    class="fill-current"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M18.8839 5.11612C19.372 5.60427 19.372 6.39573 18.8839 6.88388L6.88388 18.8839C6.39573 19.372 5.60427 19.372 5.11612 18.8839C4.62796 18.3957 4.62796 17.6043 5.11612 17.1161L17.1161 5.11612C17.6043 4.62796 18.3957 4.62796 18.8839 5.11612Z"
                    />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M5.11612 5.11612C5.60427 4.62796 6.39573 4.62796 6.88388 5.11612L18.8839 17.1161C19.372 17.6043 19.372 18.3957 18.8839 18.8839C18.3957 19.372 17.6043 19.372 17.1161 18.8839L5.11612 6.88388C4.62796 6.39573 4.62796 5.60427 5.11612 5.11612Z"
                    />
                </svg>
            </button>
        </div>
    </div>
</section>
