<template>
    <div id="app" class="font-sans bg-gray-100 min-h-screen">
      <header class="bg-teal-500 text-white p-4">
        <nav>
          <ul class="flex space-x-4">
            <li>
              <router-link to="/" class="hover:text-teal-300">Клієнти</router-link>
            </li>
            <li>
              <router-link to="/clients/create" class="hover:text-teal-300">Створити клієнта</router-link>
            </li>
          </ul>
        </nav>
      </header>

      <main class="p-6">
        <router-view />
      </main>
    </div>
</template>

<script>
  export default {
    name: 'App',
  };
</script>
