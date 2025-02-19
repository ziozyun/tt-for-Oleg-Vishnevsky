<template>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">
        {{ client.id ? "Редагувати клієнта" : "Створити нового клієнта" }}
      </h1>

      <form @submit.prevent="submitForm" class="bg-white p-6 rounded-md shadow-md">
        <div class="mb-4">
          <label for="first_name" class="block text-sm font-medium text-gray-700">Ім'я</label>
          <input
            type="text"
            id="first_name"
            v-model="client.first_name"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
        </div>

        <div class="mb-4">
          <label for="last_name" class="block text-sm font-medium text-gray-700">Фамілія</label>
          <input
            type="text"
            id="last_name"
            v-model="client.last_name"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
        </div>

        <div class="mb-4">
          <label for="city_id" class="block text-sm font-medium text-gray-700">Місто</label>
          <select
            id="city_id"
            v-model="client.city_id"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          >
            <option disabled value="">Виберіть місто</option>
            <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="contacts" class="block text-sm font-medium text-gray-700">Контакти</label>
          <div v-for="(contact, index) in client.contacts" :key="index" class="mb-2">
            <div class="flex space-x-2">
              <select
                v-model="contact.type"
                class="block w-1/4 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              >
                <option value="Phone">Телефон</option>
                <option value="Email">Email</option>
              </select>
              <input
                type="text"
                v-model="contact.value"
                placeholder="Контакт"
                class="block w-3/4 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <button
              type="button"
              @click="removeContact(index)"
              class="text-red-500 hover:underline"
            >
              Видалити контакт
            </button>
          </div>
          <button type="button" @click="addContact" class="text-blue-500 hover:underline">
            Додати контакт
          </button>
        </div>

        <button
          type="submit"
          class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600"
        >
          {{ client.id ? "Зберегти зміни" : "Створити клієнта" }}
        </button>
      </form>
    </div>
</template>

<script>
  import axios from 'axios';

  export default {
    data() {
      return {
        client: {
          first_name: '',
          last_name: '',
          city_id: '',
          contacts: [{ type: 'Phone', value: '' }],
        },
        cities: [],
      };
    },
    mounted() {
      if (this.$route.params.id) {
        this.fetchClient();
      }
      this.fetchCities();
    },
    methods: {
      async fetchClient() {
        try {
          const response = await axios.get(`/api/clients/${this.$route.params.id}`);
          this.client = response.data;
        } catch (error) {
          console.error("Помилка при отримані інформації клієнта:", error);
        }
      },
      async fetchCities() {
        try {
          const response = await axios.get('/api/cities');
          this.cities = response.data;
        } catch (error) {
          console.error("Помилка при отримані міст:", error);
        }
      },
      addContact() {
        this.client.contacts.push({ type: 'phone', value: '' });
      },
      removeContact(index) {
        this.client.contacts.splice(index, 1);
      },
      async submitForm() {
        try {
          if (this.client.id) {
            await axios.put(`/api/clients/${this.client.id}`, this.client);
          } else {
            await axios.post('/api/clients', this.client);
          }
          this.$router.push('/');
        } catch (error) {
          console.error("Помилка при збережені клієнта:", error);
        }
      },
    },
  };
</script>
