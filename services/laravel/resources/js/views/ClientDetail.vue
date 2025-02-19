<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Деталі клієнта</h1>

      <div v-if="client" class="bg-white p-6 rounded-md shadow-md">
        <div class="mb-4">
          <h2 class="text-xl font-semibold">Особисті дані</h2>
          <p><strong>Ім'я:</strong> {{ client.first_name }}</p>
          <p><strong>Фамілія:</strong> {{ client.last_name }}</p>
          <p><strong>Місто:</strong> {{ client.city.name }}</p>
        </div>

        <div class="mb-4">
          <h2 class="text-xl font-semibold">Контакти</h2>
          <ul>
            <li v-for="contact in client.contacts" :key="contact.id">
              <p><strong>{{ contact.type }}:</strong> {{ contact.value }}</p>
            </li>
          </ul>
        </div>

        <div class="mb-4">
          <router-link :to="'/clients/' + client.id + '/edit'" class="text-blue-500 hover:underline">
            Редагувати клієнта
          </router-link>
        </div>

        <div class="mb-4">
          <button
            @click="deleteClient"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600"
          >
            Видалити клієнта
          </button>
        </div>
      </div>

      <div v-else class="text-center text-gray-500">
        Клієнт не знайдений.
      </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    export default {
      data() {
        return {
          client: null,
        };
      },
      mounted() {
        this.fetchClient();
      },
      methods: {
        async fetchClient() {
          const clientId = this.$route.params.id;
          try {
            const response = await axios.get(`/api/clients/${clientId}`);
            this.client = response.data;
          } catch (error) {
            console.error("Помилк отримання клієнта:", error);
          }
        },

        async deleteClient() {
          const clientId = this.$route.params.id;
          try {
            const confirmDelete = confirm("Ви дійсно хочете видалити цього клієнта?");
            if (confirmDelete) {
              await axios.delete(`/api/clients/${clientId}`);
              this.$router.push('/');
            }
          } catch (error) {
            console.error("Помилка видалення клієнта:", error);
          }
        },
      },
    };
</script>
