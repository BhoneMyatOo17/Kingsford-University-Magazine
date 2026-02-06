@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-[#dc2d3d] hover:bg-[#b82532] text-white font-semibold py-3 px-4 rounded-md transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#dc2d3d] focus:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:bg-[#dc2d3d]']) }}>
    {{ $slot }}
</button>