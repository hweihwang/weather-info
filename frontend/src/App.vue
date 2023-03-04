<script setup lang="ts">
import { onMounted, ref } from "vue";

interface WeatherInfo {
  city: string;
  temperature: number;
  temperatureUnit: string;
  description: string;
  windSpeed: number;
  humidity: number;
  pressure: number;
  visibility: number;
  iconUrl: string;
}

interface User {
  name: string;
  lat: number;
  lon: number;
  weather: WeatherInfo;
}

const users = ref<User[]>([]);

const selectedUser = ref<User | null>(null);

const modalVisible = ref<boolean>(false);

const showModal = (user: User) => {
  selectedUser.value = user;
  modalVisible.value = true;
};

const hideModal = () => {
  modalVisible.value = false;
};

onMounted(async () => {
  try {
    const response = await fetch("http://localhost:19000/weather-info/api/v1");
    users.value = await response.json();
  } catch (error) {
    console.error(error);
  }
});
</script>

<template>
  <div class="container mx-auto mt-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      <div
        v-for="user in users"
        :key="user.name"
        class="p-4 rounded-lg shadow-md bg-white cursor-pointer"
        @click="showModal(user)"
      >
        <h2 class="text-lg font-bold">{{ user.name }}</h2>
        <div class="mt-2">
          <img
            :src="user.weather.iconUrl"
            alt="Weather Icon"
            class="h-20 inline-block"
          />
          <div class="inline-block align-middle">
            <p class="text-sm font-semibold">{{ user.weather.city }}</p>
            <p class="text-sm">{{ user.weather.description }}</p>
            <p class="text-sm">
              {{ user.weather.temperature.toFixed(2) }} &deg;{{
                user.weather.temperatureUnit
              }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div
      class="fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex justify-center items-center"
      v-if="modalVisible"
      @click.self="hideModal"
    >
      <div class="bg-white rounded-lg shadow-md max-w-lg mx-auto">
        <div class="p-8">
          <h2 class="text-lg font-bold mb-4">{{ selectedUser?.name }}</h2>
          <div class="mb-2">
            <strong>City:</strong> {{ selectedUser?.weather.city }}
          </div>
          <div class="mb-2">
            <strong>Latitude:</strong> {{ selectedUser?.lat }}
          </div>
          <div class="mb-2">
            <strong>Longitude:</strong> {{ selectedUser?.lon }}
          </div>
          <div class="mb-2">
            <strong>Temperature:</strong>
            {{ selectedUser?.weather.temperature }} &deg;{{
              selectedUser?.weather.temperatureUnit
            }}
          </div>
          <div class="mb-2">
            <strong>Description:</strong>
            {{ selectedUser?.weather.description }}
          </div>
          <div class="mb-2">
            <strong>Wind Speed:</strong>
            {{ selectedUser?.weather.windSpeed }} km/h
          </div>
          <div class="mb-2">
            <strong>Humidity:</strong> {{ selectedUser?.weather.humidity }} %
          </div>
          <div class="mb-2">
            <strong>Pressure:</strong> {{ selectedUser?.weather.pressure }} hPa
          </div>
          <div class="mb-2">
            <strong>Visibility:</strong>
            {{ selectedUser?.weather.visibility }} m
          </div>
          <div class="mb-2">
            <strong>Icon:</strong>
            <img
              :src="selectedUser?.weather.iconUrl"
              alt="Weather Icon"
              class="h-20 inline-block"
            />
          </div>
          <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4"
            @click="hideModal"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
