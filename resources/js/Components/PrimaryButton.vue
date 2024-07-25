<template>
    <button
        class="inline-flex items-center px-4 py-2 bg-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-700  transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>

<style>
.bg-red {
    background-color: #e51c1c;
}

</style>
