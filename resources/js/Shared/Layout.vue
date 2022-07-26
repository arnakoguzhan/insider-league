<template>
  <section class="p-6 bg-gray-200">
    <header class="max-w-5xl mx-auto">
      <div class="flex items-center justify-between">
        <Logo />
        <Link href="/">
        New simulation
        </Link>
      </div>
    </header>
  </section>

  <section class="p-6">
    <div class="max-w-5xl mx-auto">
      <slot />
    </div>
  </section>
</template>

<script setup>
import Logo from './Logo.vue';
</script>