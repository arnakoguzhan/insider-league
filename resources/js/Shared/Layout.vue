<template>
  <section class="p-6 bg-gray-200">
    <header class="max-w-5xl mx-auto">
      <div class="flex items-center justify-between">
        <h1 class="font-bold text-lg">
          Insider Champions League
        </h1>

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