<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Список клієнтів</h1>

      <div v-if="clients.length > 0">
        <table class="min-w-full bg-white border border-gray-300">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b">Ім'я</th>
              <th class="py-2 px-4 border-b">Фамілія</th>
              <th class="py-2 px-4 border-b">Місто</th>
              <th class="py-2 px-4 border-b">Контакти</th>
              <th class="py-2 px-4 border-b">Дії</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="client in clients" :key="client.id">
              <td class="py-2 px-4 border-b">{{ client.first_name }}</td>
              <td class="py-2 px-4 border-b">{{ client.last_name }}</td>
              <td class="py-2 px-4 border-b">{{ client.city.name }}</td>
              <td class="py-2 px-4 border-b">{{ client.contacts_count }}</td>
              <td class="py-2 px-4 border-b">
                <router-link :to="'/clients/' + client.id" class="text-blue-500 hover:underline">Переглянути</router-link>
                <router-link :to="'/clients/' + client.id + '/edit'" class="text-yellow-500 hover:underline ml-2">Редагувати</router-link>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="mt-4 flex justify-between">
          <button
            v-if="pagination.prev_page_url"
            @click="fetchClients(pagination.prev_page_url)"
            class="px-4 py-2 bg-blue-500 text-white rounded-md"
          >
            Попередня
          </button>
          <button
            v-if="pagination.next_page_url"
            @click="fetchClients(pagination.next_page_url)"
            class="px-4 py-2 bg-blue-500 text-white rounded-md"
          >
            Наступна
          </button>
        </div>
      </div>

      <div v-else class="text-center text-gray-500">
        Немає клієнтів.
      </div>
    </div>
</template>

<script>
  import axios from 'axios';

  export default {
    data() {
      return {
        clients: [],
        pagination: {
          current_page: 1,
          prev_page_url: null,
          next_page_url: null,
        },
      };
    },
    mounted() {
      this.fetchClients();
    },
    methods: {
      async fetchClients(pageUrl = '/api/clients') {
        try {
          const response = await axios.get(pageUrl);
          this.clients = response.data.data;

          this.pagination = {
            current_page: response.data.current_page,
            prev_page_url: response.data.prev_page_url,
            next_page_url: response.data.next_page_url,
          };
        } catch (error) {
          console.error("Помилка при отриманні клієнтів:", error);
        }
      },
    },
  };
</script>
