<div
    x-data="{ show: false, message: '', type: 'success' }"
    x-on:show-toast.window="
        message = $event.detail.message;
        type = $event.detail.type;
        show = true;
        setTimeout(() => show = false, 3000);
    "
    x-show="show"
    x-transition.opacity
    class="fixed top-5 right-5 flex items-center space-x-2 px-4 py-3 rounded-2xl shadow-lg text-white font-semibold z-50"
    :class="{
        'bg-green-600': type === 'success',
        'bg-red-600': type === 'error'
    }"
    style="display: none;"
>
    <template x-if="type === 'success'">
        <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' /></svg>
    </template>
    <template x-if="type === 'error'">
        <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg>
    </template>
    <span x-text="message"></span>
</div>
