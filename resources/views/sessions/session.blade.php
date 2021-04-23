<template>
    <div class="p-10">
        <div class="flex items-center text-white text-sm font-bold px-4 py-3 rounded shadow-md" :class="alertBackgroundColor" role="alert">
            <span x-html="alertMessage" class="flex"></span>
            <button type="button" class="flex" @click="openAlertBox = false">
                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 ml-4"><path d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
</template>